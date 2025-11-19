<?php

namespace App\Filament\Resources\Reports\Pages;

use App\Filament\Resources\Reports\ReportResource;
use Filament\Resources\Pages\Page;
use Filament\Actions\Action;
use Livewire\Attributes\On;
use App\Models\Inventory;
use App\Models\Organization;
use App\Models\Site;
use App\Models\EquipmentType;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Response;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Shared\Converter;

class ListReports extends Page
{
    protected static string $resource = ReportResource::class;

    protected static ?string $title = 'Generate Laporan';
    
    public ?array $data = [];
    public $selectedMonth;
    public $selectedYear;

    public function mount(): void
    {
        $this->selectedMonth = now()->format('m');
        $this->selectedYear = now()->format('Y');
    }

    public function getSubheading(): ?string
    {
        return 'Sistem Pelaporan - Generate laporan inventaris dalam format PDF atau DOCX';
    }

    protected function getHeaderActions(): array
    {
        return [
            // Site Jarkom Group
            Action::make('siteJarkomPdf')
                ->label('Site Jarkom (PDF)')
                ->icon('heroicon-o-document')
                ->color('success')
                ->action('generateSiteJarkomReport'),
            
            Action::make('siteJarkomDocx')
                ->label('Site Jarkom (DOCX)')
                ->icon('heroicon-o-document-text')
                ->color('success')
                ->outlined()
                ->action('generateSiteJarkomReportDocx'),
            
            // Data ALKOM Group
            Action::make('dataAlkomPdf')
                ->label('Data ALKOM (PDF)')
                ->icon('heroicon-o-document')
                ->color('info')
                ->action('generateDataAlkomReport'),
            
            Action::make('dataAlkomDocx')
                ->label('Data ALKOM (DOCX)')
                ->icon('heroicon-o-document-text')
                ->color('info')
                ->outlined()
                ->action('generateDataAlkomReportDocx'),
            
            // Other Reports
            Action::make('inventoryReport')
                ->label('Inventaris Summary')
                ->icon('heroicon-o-chart-bar')
                ->color('primary')
                ->action('generateInventoryReport'),
            
            Action::make('equipmentType')
                ->label('Jenis Perangkat')
                ->icon('heroicon-o-cpu-chip')
                ->color('warning')
                ->action('generateEquipmentTypeReport'),
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            \App\Filament\Widgets\ReportStatsWidget::class,
            \App\Filament\Widgets\ReportGuideWidget::class,
        ];
    }



    private function getMonthName($monthNumber)
    {
        $months = [
            '01' => 'JANUARI', '02' => 'FEBRUARI', '03' => 'MARET',
            '04' => 'APRIL', '05' => 'MEI', '06' => 'JUNI',
            '07' => 'JULI', '08' => 'AGUSTUS', '09' => 'SEPTEMBER',
            '10' => 'OKTOBER', '11' => 'NOVEMBER', '12' => 'DESEMBER',
        ];
        return $months[$monthNumber] ?? 'UNKNOWN';
    }

    private function getReportPeriod()
    {
        $month = $this->selectedMonth ?? now()->format('m');
        $year = $this->selectedYear ?? now()->format('Y');
        return [
            'month' => $month,
            'year' => $year,
            'month_name' => $this->getMonthName($month),
            'formatted' => 'S/D BULAN ' . $this->getMonthName($month) . ' ' . $year,
        ];
    }

    public function generateSiteJarkomReport()
    {
        $data = $this->getSiteJarkomData();
        $period = $this->getReportPeriod();
        $data['period'] = $period;
        
        $pdf = Pdf::loadView('reports.site-jarkom-repeater', compact('data'))
            ->setPaper('A4', 'portrait');
            
        return Response::streamDownload(
            fn () => print($pdf->output()),
            'Laporan_Site_Jarkom_Repeater_' . $period['month'] . '_' . $period['year'] . '.pdf'
        );
    }

    public function generateSiteJarkomReportDocx()
    {
        $data = $this->getSiteJarkomData();
        $period = $this->getReportPeriod();
        
        $phpWord = new PhpWord();
        
        // Set document properties
        $properties = $phpWord->getDocInfo();
        $properties->setCreator('POLDA Jambi');
        $properties->setTitle('Data Site Jarkom Repeater');
        
        // Create section with portrait orientation
        $section = $phpWord->addSection([
            'marginTop' => Converter::cmToTwip(0.5),
            'marginBottom' => Converter::cmToTwip(0.5),
            'marginLeft' => Converter::cmToTwip(0.5),
            'marginRight' => Converter::cmToTwip(0.5),
        ]);
        
        // Add logo placeholder (right aligned)
        $textRun = $section->addTextRun(['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::END]);
        $textRun->addText('[LOGO POLRI]', ['size' => 8, 'bold' => true], ['spaceAfter' => 0]);
        
        // Add title
        $section->addText(
            'DATA SITE JARKOM REPEATER',
            ['bold' => true, 'size' => 14, 'underline' => 'single'],
            ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 0]
        );
        
        $section->addText(
            'POLDA JAMBI DAN JAJARAN ' . $period['formatted'],
            ['bold' => true, 'size' => 14, 'underline' => 'single'],
            ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 200]
        );
        
        // Define table style
        $tableStyle = [
            'borderColor' => '000000',
            'borderSize' => 6,
            'cellMargin' => 20,
            'width' => 100 * 50,
            'unit' => \PhpOffice\PhpWord\SimpleType\TblWidth::PERCENT,
        ];
        
        $phpWord->addTableStyle('JarkomTable', $tableStyle);
        
        // Create table
        $table = $section->addTable('JarkomTable');
        
        // Header styles
        $headerStyle = ['bgColor' => 'F0F0F0', 'valign' => 'center'];
        $headerTextStyle = ['bold' => true, 'size' => 8];
        $headerTextStyleSmall = ['bold' => true, 'size' => 7];
        
        // Header row 1 (with rowspan and colspan)
        $table->addRow(400);
        $cell = $table->addCell(500, array_merge($headerStyle, ['vMerge' => 'restart']));
        $cell->addText('NO', $headerTextStyle, ['alignment' => 'center']);
        
        $cell = $table->addCell(2000, array_merge($headerStyle, ['vMerge' => 'restart']));
        $textRun = $cell->addTextRun(['alignment' => 'center']);
        $textRun->addText('SATWIL', $headerTextStyle);
        $textRun->addLineBreak();
        $textRun->addLineBreak();
        $textRun->addText('NAMA SITE', $headerTextStyle);
        
        $cell = $table->addCell(3200, array_merge($headerStyle, ['gridSpan' => 4]));
        $cell->addText('STATUS SITE / TOWER', $headerTextStyle, ['alignment' => 'center']);
        
        $cell = $table->addCell(1800, array_merge($headerStyle, ['vMerge' => 'restart']));
        $textRun = $cell->addTextRun(['alignment' => 'center']);
        $textRun->addText('JENIS', $headerTextStyle);
        $textRun->addLineBreak();
        $textRun->addText('REPEATER /', $headerTextStyle);
        $textRun->addLineBreak();
        $textRun->addText('PERANGKAT', $headerTextStyle);
        $textRun->addLineBreak();
        $textRun->addText('EXISTING', $headerTextStyle);
        
        $cell = $table->addCell(500, array_merge($headerStyle, ['vMerge' => 'restart']));
        $textRun = $cell->addTextRun(['alignment' => 'center']);
        $textRun->addText('TAH', $headerTextStyle);
        $textRun->addLineBreak();
        $textRun->addText('UN', $headerTextStyle);
        
        $cell = $table->addCell(500, array_merge($headerStyle, ['vMerge' => 'restart']));
        $cell->addText('VOL', $headerTextStyle, ['alignment' => 'center']);
        
        $cell = $table->addCell(500, array_merge($headerStyle, ['vMerge' => 'restart']));
        $cell->addText('SAT', $headerTextStyle, ['alignment' => 'center']);
        
        $cell = $table->addCell(1500, array_merge($headerStyle, ['gridSpan' => 3]));
        $cell->addText('KONDISI', $headerTextStyle, ['alignment' => 'center']);
        
        $cell = $table->addCell(1500, array_merge($headerStyle, ['vMerge' => 'restart']));
        $cell->addText('KET', $headerTextStyle, ['alignment' => 'center']);
        
        // Header row 2 (sub headers)
        $table->addRow(400);
        $table->addCell(null, array_merge($headerStyle, ['vMerge' => 'continue']));
        $table->addCell(null, array_merge($headerStyle, ['vMerge' => 'continue']));
        
        $cell = $table->addCell(800, $headerStyle);
        $cell->addText('POLRI', $headerTextStyle, ['alignment' => 'center']);
        
        $cell = $table->addCell(800, $headerStyle);
        $textRun = $cell->addTextRun(['alignment' => 'center']);
        $textRun->addText('TELKO', $headerTextStyle);
        $textRun->addLineBreak();
        $textRun->addText('M', $headerTextStyle);
        
        $cell = $table->addCell(800, $headerStyle);
        $cell->addText('TVRI', $headerTextStyle, ['alignment' => 'center']);
        
        $cell = $table->addCell(800, $headerStyle);
        $textRun = $cell->addTextRun(['alignment' => 'center']);
        $textRun->addText('INDOS', $headerTextStyle);
        $textRun->addLineBreak();
        $textRun->addText('AT', $headerTextStyle);
        
        $table->addCell(null, array_merge($headerStyle, ['vMerge' => 'continue']));
        $table->addCell(null, array_merge($headerStyle, ['vMerge' => 'continue']));
        $table->addCell(null, array_merge($headerStyle, ['vMerge' => 'continue']));
        $table->addCell(null, array_merge($headerStyle, ['vMerge' => 'continue']));
        
        $table->addCell(500, $headerStyle)->addText('BB', $headerTextStyle, ['alignment' => 'center']);
        $table->addCell(500, $headerStyle)->addText('RR', $headerTextStyle, ['alignment' => 'center']);
        $table->addCell(500, $headerStyle)->addText('RB', $headerTextStyle, ['alignment' => 'center']);
        
        $table->addCell(null, array_merge($headerStyle, ['vMerge' => 'continue']));
        
        // Header row 3 (column numbers)
        $table->addRow(300);
        for ($i = 1; $i <= 14; $i++) {
            $table->addCell(null, $headerStyle)->addText((string)$i, $headerTextStyleSmall, ['alignment' => 'center']);
        }
        
        // Organization row style (yellow background)
        $orgRowStyle = ['bgColor' => 'FFFF00', 'valign' => 'center'];
        $orgTextStyle = ['bold' => true, 'size' => 9];
        
        // Site row style (white background with bold text)
        $siteRowStyle = ['bgColor' => 'FFFFFF', 'valign' => 'center'];
        $siteTextStyle = ['bold' => true, 'size' => 9];
        $siteTextStyleSmall = ['size' => 7, 'color' => '555555'];
        
        // Tower row style (white background)
        $towerRowStyle = ['valign' => 'center'];
        $towerTextStyle = ['size' => 9];
        
        $orgIndex = 1;
        $siteIndex = 'a';
        
        // Loop through organizations
        foreach ($data['organizations'] as $orgData) {
            // Organization row
            $table->addRow(350);
            $table->addCell(500, $orgRowStyle)->addText($orgIndex . '.', $orgTextStyle, ['alignment' => 'center']);
            $table->addCell(2000, $orgRowStyle)->addText(strtoupper($orgData['organization']), $orgTextStyle);
            $table->addCell(800, $orgRowStyle)->addText($orgData['status_totals']['POLRI'] ?: '-', $orgTextStyle, ['alignment' => 'center']);
            $table->addCell(800, $orgRowStyle)->addText($orgData['status_totals']['TELKOM'] ?: '-', $orgTextStyle, ['alignment' => 'center']);
            $table->addCell(800, $orgRowStyle)->addText($orgData['status_totals']['TVRI'] ?: '-', $orgTextStyle, ['alignment' => 'center']);
            $table->addCell(800, $orgRowStyle)->addText($orgData['status_totals']['INDOSAT'] ?: '-', $orgTextStyle, ['alignment' => 'center']);
            $table->addCell(1800, $orgRowStyle)->addText('-', $orgTextStyle, ['alignment' => 'center']);
            $table->addCell(500, $orgRowStyle)->addText('-', $orgTextStyle, ['alignment' => 'center']);
            $table->addCell(500, $orgRowStyle)->addText((string)$orgData['tower_count'], $orgTextStyle, ['alignment' => 'center']);
            $table->addCell(500, $orgRowStyle)->addText('Unit', $orgTextStyle, ['alignment' => 'center']);
            $table->addCell(500, $orgRowStyle)->addText($orgData['condition_totals']['bb'] ?: '-', $orgTextStyle, ['alignment' => 'center']);
            $table->addCell(500, $orgRowStyle)->addText($orgData['condition_totals']['rr'] ?: '-', $orgTextStyle, ['alignment' => 'center']);
            $table->addCell(500, $orgRowStyle)->addText($orgData['condition_totals']['rb'] ?: '-', $orgTextStyle, ['alignment' => 'center']);
            $table->addCell(1500, $orgRowStyle)->addText('', $orgTextStyle);
            
            $siteIndex = 'a';
            // Loop through sites in this organization
            foreach ($orgData['sites'] as $site) {
                // Site row
                $table->addRow(350);
                $table->addCell(500, $siteRowStyle)->addText($siteIndex . '.', $siteTextStyle, ['alignment' => 'center']);
                
                // Site name with location and height
                $cell = $table->addCell(2000, $siteRowStyle);
                $textRun = $cell->addTextRun();
                $textRun->addText($site['name'], $siteTextStyle);
                if ($site['location'] || $site['tower_height']) {
                    $textRun->addLineBreak();
                    $locationText = $site['location'] ?? '';
                    if ($site['tower_height']) {
                        $locationText .= ($locationText ? ' ' : '') . 'SST ' . $site['tower_height'];
                    }
                    $textRun->addText($locationText, $siteTextStyleSmall);
                }
                
                $table->addCell(800, $siteRowStyle)->addText($site['status_counts']['POLRI'] ? 'POLRI' : '-', $siteTextStyle, ['alignment' => 'center']);
                $table->addCell(800, $siteRowStyle)->addText($site['status_counts']['TELKOM'] ? 'TELKOM' : '-', $siteTextStyle, ['alignment' => 'center']);
                $table->addCell(800, $siteRowStyle)->addText($site['status_counts']['TVRI'] ? 'TVRI' : '-', $siteTextStyle, ['alignment' => 'center']);
                $table->addCell(800, $siteRowStyle)->addText($site['status_counts']['INDOSAT'] ? 'INDOSAT' : '-', $siteTextStyle, ['alignment' => 'center']);
                $table->addCell(1800, $siteRowStyle)->addText('REPEATER', $siteTextStyle, ['alignment' => 'center']);
                $table->addCell(500, $siteRowStyle)->addText('-', $siteTextStyle, ['alignment' => 'center']);
                $table->addCell(500, $siteRowStyle)->addText((string)$site['volume'], $siteTextStyle, ['alignment' => 'center']);
                $table->addCell(500, $siteRowStyle)->addText('Unit', $siteTextStyle, ['alignment' => 'center']);
                $table->addCell(500, $siteRowStyle)->addText('', $siteTextStyle);
                $table->addCell(500, $siteRowStyle)->addText('', $siteTextStyle);
                $table->addCell(500, $siteRowStyle)->addText('', $siteTextStyle);
                $table->addCell(1500, $siteRowStyle)->addText('', $siteTextStyle);
                
                // Loop through towers in this site
                foreach ($site['towers'] as $tower) {
                    $table->addRow(350);
                    $table->addCell(500, $towerRowStyle)->addText('', $towerTextStyle);
                    
                    // Tower name with indent
                    $cell = $table->addCell(2000, $towerRowStyle);
                    $userOrType = $tower['user'] ?? $tower['repeater_type'];
                    $cell->addText('- ' . $userOrType, $towerTextStyle);
                    
                    $table->addCell(800, $towerRowStyle)->addText('', $towerTextStyle);
                    $table->addCell(800, $towerRowStyle)->addText('', $towerTextStyle);
                    $table->addCell(800, $towerRowStyle)->addText('', $towerTextStyle);
                    $table->addCell(800, $towerRowStyle)->addText('', $towerTextStyle);
                    $table->addCell(1800, $towerRowStyle)->addText($tower['repeater_type'] ?? '-', $towerTextStyle, ['alignment' => 'center']);
                    $table->addCell(500, $towerRowStyle)->addText($tower['year'] ?? '-', $towerTextStyle, ['alignment' => 'center']);
                    $table->addCell(500, $towerRowStyle)->addText('1', $towerTextStyle, ['alignment' => 'center']);
                    $table->addCell(500, $towerRowStyle)->addText('Unit', $towerTextStyle, ['alignment' => 'center']);
                    $table->addCell(500, $towerRowStyle)->addText($tower['condition_bb'] ?: '-', $towerTextStyle, ['alignment' => 'center']);
                    $table->addCell(500, $towerRowStyle)->addText($tower['condition_rr'] ?: '-', $towerTextStyle, ['alignment' => 'center']);
                    $table->addCell(500, $towerRowStyle)->addText($tower['condition_rb'] ?: '-', $towerTextStyle, ['alignment' => 'center']);
                    $table->addCell(1500, $towerRowStyle)->addText($tower['notes'] ?? '', ['size' => 7], []);
                }
                
                $siteIndex++;
            }
            
            $orgIndex++;
        }
        
        // Add JUMLAH rows (4 rows with yellow background matching PDF)
        $jumlahRowStyle = ['bgColor' => 'FFFF00', 'valign' => 'center'];
        $jumlahTextStyle = ['bold' => true, 'size' => 9];
        $whiteRowStyle = ['bgColor' => 'FFFFFF', 'valign' => 'center'];
        
        // Row 1: JUMLAH with RPT + KOMOB + LINK
        $table->addRow(350);
        $cell = $table->addCell(2500, array_merge($jumlahRowStyle, ['gridSpan' => 2]));
        $cell->addText('JUMLAH', $jumlahTextStyle, ['alignment' => 'center']);
        $table->addCell(800, $jumlahRowStyle)->addText($data['totals']['status']['POLRI'] ?? '-', $jumlahTextStyle, ['alignment' => 'center']);
        $table->addCell(800, $jumlahRowStyle)->addText($data['totals']['status']['TELKOM'] ?? '-', $jumlahTextStyle, ['alignment' => 'center']);
        $table->addCell(800, $jumlahRowStyle)->addText($data['totals']['status']['TVRI'] ?? '-', $jumlahTextStyle, ['alignment' => 'center']);
        $table->addCell(800, $jumlahRowStyle)->addText($data['totals']['status']['INDOSAT'] ?? '-', $jumlahTextStyle, ['alignment' => 'center']);
        $table->addCell(1800, $jumlahRowStyle)->addText('RPT + KOMOB + LINK', $jumlahTextStyle, ['alignment' => 'center']);
        $table->addCell(500, $jumlahRowStyle)->addText('', $jumlahTextStyle);
        $table->addCell(500, $jumlahRowStyle)->addText($data['totals']['towers'] ?? '-', $jumlahTextStyle, ['alignment' => 'center']);
        $table->addCell(500, $jumlahRowStyle)->addText('Unit', $jumlahTextStyle, ['alignment' => 'center']);
        $table->addCell(500, $jumlahRowStyle)->addText($data['totals']['condition']['bb'] ?? '-', $jumlahTextStyle, ['alignment' => 'center']);
        $table->addCell(500, $jumlahRowStyle)->addText($data['totals']['condition']['rr'] ?? '-', $jumlahTextStyle, ['alignment' => 'center']);
        $table->addCell(500, $jumlahRowStyle)->addText($data['totals']['condition']['rb'] ?? '-', $jumlahTextStyle, ['alignment' => 'center']);
        $table->addCell(1500, $jumlahRowStyle)->addText('', $jumlahTextStyle);
        
        // Row 2: Empty cols + KOMOB RPT
        $table->addRow(350);
        $table->addCell(2500, array_merge($whiteRowStyle, ['gridSpan' => 2]))->addText('', $jumlahTextStyle);
        $table->addCell(800, $whiteRowStyle)->addText('', $jumlahTextStyle);
        $table->addCell(800, $whiteRowStyle)->addText('', $jumlahTextStyle);
        $table->addCell(800, $whiteRowStyle)->addText('', $jumlahTextStyle);
        $table->addCell(800, $whiteRowStyle)->addText('', $jumlahTextStyle);
        $table->addCell(1800, $whiteRowStyle)->addText('KOMOB RPT', $jumlahTextStyle, ['alignment' => 'center']);
        $table->addCell(500, $whiteRowStyle)->addText('', $jumlahTextStyle);
        $table->addCell(500, $whiteRowStyle)->addText($data['totals']['komob'] ?? '-', $jumlahTextStyle, ['alignment' => 'center']);
        $table->addCell(500, $whiteRowStyle)->addText('Unit', $jumlahTextStyle, ['alignment' => 'center']);
        $table->addCell(500, $whiteRowStyle)->addText($data['totals']['komob_bb'] ?? '-', $jumlahTextStyle, ['alignment' => 'center']);
        $table->addCell(500, $whiteRowStyle)->addText('-', $jumlahTextStyle, ['alignment' => 'center']);
        $table->addCell(500, $whiteRowStyle)->addText('-', $jumlahTextStyle, ['alignment' => 'center']);
        $table->addCell(1500, $whiteRowStyle)->addText('', $jumlahTextStyle);
        
        // Row 3: JUMLAH + LINK
        $table->addRow(350);
        $cell = $table->addCell(2500, array_merge($whiteRowStyle, ['gridSpan' => 2]));
        $cell->addText('JUMLAH', $jumlahTextStyle, ['alignment' => 'center']);
        $table->addCell(800, $whiteRowStyle)->addText('', $jumlahTextStyle);
        $table->addCell(800, $whiteRowStyle)->addText('', $jumlahTextStyle);
        $table->addCell(800, $whiteRowStyle)->addText('', $jumlahTextStyle);
        $table->addCell(800, $whiteRowStyle)->addText('', $jumlahTextStyle);
        $table->addCell(1800, $whiteRowStyle)->addText('LINK', $jumlahTextStyle, ['alignment' => 'center']);
        $table->addCell(500, $whiteRowStyle)->addText('', $jumlahTextStyle);
        $table->addCell(500, $whiteRowStyle)->addText($data['totals']['link'] ?? '-', $jumlahTextStyle, ['alignment' => 'center']);
        $table->addCell(500, $whiteRowStyle)->addText('Unit', $jumlahTextStyle, ['alignment' => 'center']);
        $table->addCell(500, $whiteRowStyle)->addText($data['totals']['link_bb'] ?? '-', $jumlahTextStyle, ['alignment' => 'center']);
        $table->addCell(500, $whiteRowStyle)->addText('-', $jumlahTextStyle, ['alignment' => 'center']);
        $table->addCell(500, $whiteRowStyle)->addText($data['totals']['link_rb'] ?? '-', $jumlahTextStyle, ['alignment' => 'center']);
        $table->addCell(1500, $whiteRowStyle)->addText('', $jumlahTextStyle);
        
        // Row 4: JUMLAH + REPEATER (yellow background)
        $table->addRow(350);
        $cell = $table->addCell(2500, array_merge($jumlahRowStyle, ['gridSpan' => 2]));
        $cell->addText('JUMLAH', $jumlahTextStyle, ['alignment' => 'center']);
        $table->addCell(800, $jumlahRowStyle)->addText($data['totals']['status']['POLRI'] ?? '-', $jumlahTextStyle, ['alignment' => 'center']);
        $table->addCell(800, $jumlahRowStyle)->addText($data['totals']['status']['TELKOM'] ?? '-', $jumlahTextStyle, ['alignment' => 'center']);
        $table->addCell(800, $jumlahRowStyle)->addText($data['totals']['status']['TVRI'] ?? '-', $jumlahTextStyle, ['alignment' => 'center']);
        $table->addCell(800, $jumlahRowStyle)->addText($data['totals']['status']['INDOSAT'] ?? '-', $jumlahTextStyle, ['alignment' => 'center']);
        $table->addCell(1800, $jumlahRowStyle)->addText('REPEATER', $jumlahTextStyle, ['alignment' => 'center']);
        $table->addCell(500, $jumlahRowStyle)->addText('', $jumlahTextStyle);
        $table->addCell(500, $jumlahRowStyle)->addText($data['totals']['towers'] ?? '-', $jumlahTextStyle, ['alignment' => 'center']);
        $table->addCell(500, $jumlahRowStyle)->addText('Unit', $jumlahTextStyle, ['alignment' => 'center']);
        $table->addCell(500, $jumlahRowStyle)->addText($data['totals']['condition']['bb'] ?? '-', $jumlahTextStyle, ['alignment' => 'center']);
        $table->addCell(500, $jumlahRowStyle)->addText($data['totals']['condition']['rr'] ?? '-', $jumlahTextStyle, ['alignment' => 'center']);
        $table->addCell(500, $jumlahRowStyle)->addText($data['totals']['condition']['rb'] ?? '-', $jumlahTextStyle, ['alignment' => 'center']);
        $table->addCell(1500, $jumlahRowStyle)->addText('', $jumlahTextStyle);
        
        // Add page number text at bottom
        $section->addText(
            '2',
            ['bold' => true, 'size' => 12],
            ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::END, 'spaceBefore' => 200]
        );
        
        // Save to temporary file
        $tempFile = tempnam(sys_get_temp_dir(), 'jarkom_') . '.docx';
        $writer = IOFactory::createWriter($phpWord, 'Word2007');
        $writer->save($tempFile);
        
        return Response::download($tempFile, 'Laporan_Site_Jarkom_Repeater_' . $period['month'] . '_' . $period['year'] . '.docx')
            ->deleteFileAfterSend(true);
    }

    public function generateInventoryReport()
    {
        $data = $this->getInventoryData();
        
        $pdf = Pdf::loadView('reports.inventory-summary', compact('data'))
            ->setPaper('a4', 'portrait');
            
        return Response::streamDownload(
            fn () => print($pdf->output()),
            'Laporan_Inventaris_Summary_' . date('Y-m-d') . '.pdf'
        );
    }

    public function generateEquipmentTypeReport()
    {
        $data = $this->getEquipmentTypeData();
        
        $pdf = Pdf::loadView('reports.equipment-by-type', compact('data'))
            ->setPaper('a4', 'portrait');
            
        return Response::streamDownload(
            fn () => print($pdf->output()),
            'Laporan_Jenis_Perangkat_' . date('Y-m-d') . '.pdf'
        );
    }

    public function generateDataAlkomReport()
    {
        // Increase memory limit for this operation
        ini_set('memory_limit', '512M');
        
        $organizations = $this->getDataAlkomData();
        $period = $this->getReportPeriod();
        
        $pdf = Pdf::loadView('reports.data-alkom', compact('organizations', 'period'))
            ->setPaper('A4', 'portrait')
            ->setOptions([
                'isRemoteEnabled' => false,
                'isHtml5ParserEnabled' => false,
                'isFontSubsettingEnabled' => false
            ]);
            
        return Response::streamDownload(
            fn () => print($pdf->output()),
            'Laporan_Data_ALKOM_' . $period['month'] . '_' . $period['year'] . '.pdf'
        );
    }

    public function generateDataAlkomReportDocx()
    {
        // Increase memory limit
        ini_set('memory_limit', '512M');
        
        $data = $this->getDataAlkomData();
        $period = $this->getReportPeriod();
        
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        
        // Add A4 portrait section
        $section = $phpWord->addSection([
            'orientation' => 'portrait',
            'pageSizeW' => \PhpOffice\PhpWord\Shared\Converter::cmToTwip(21),
            'pageSizeH' => \PhpOffice\PhpWord\Shared\Converter::cmToTwip(29.7),
            'marginTop' => \PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.5),
            'marginBottom' => \PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.5),
            'marginLeft' => \PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.5),
            'marginRight' => \PhpOffice\PhpWord\Shared\Converter::cmToTwip(1.5),
        ]);

        // Title
        $section->addText(
            'DATA ALAT KOMUNIKASI',
            ['bold' => true, 'size' => 14, 'name' => 'Arial'],
            ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]
        );
        $section->addText(
            'POLDA JAMBI DAN JAJARAN ' . $period['formatted'],
            ['bold' => true, 'size' => 14, 'name' => 'Arial'],
            ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]
        );
        $section->addTextBreak();

        // Define styles
        $fontStyle = ['size' => 9, 'name' => 'Arial'];
        $headerStyle = ['bold' => true, 'size' => 9, 'name' => 'Arial'];
        $cellStyle = ['valign' => 'center'];
        $headerCellStyle = [
            'valign' => 'center',
            'bgColor' => 'CCCCCC',
        ];
        $yellowCellStyle = [
            'valign' => 'center',
            'bgColor' => 'FFFF00',
        ];

        $letterLabels = ['a.', 'b.', 'c.', 'd.', 'e.', 'f.', 'g.'];

        foreach ($data as $orgIndex => $org) {
            // Organization name
            $section->addText(
                ($orgIndex + 1) . '. ' . strtoupper($org['name']),
                ['bold' => true, 'size' => 10, 'name' => 'Arial']
            );
            $section->addTextBreak(0.5);

            // Create table with 11 columns
            $table = $section->addTable([
                'borderSize' => 6,
                'borderColor' => '000000',
                'cellMargin' => 50,
                'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER,
                'width' => 100 * 50,
            ]);

            // Header row 1
            $table->addRow(400);
            $table->addCell(400, array_merge($headerCellStyle, ['vMerge' => 'restart']))->addText('NO', $headerStyle, ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
            $table->addCell(2000, array_merge($headerCellStyle, ['vMerge' => 'restart']))->addText('JENIS AKOM', $headerStyle, ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
            $table->addCell(1000, array_merge($headerCellStyle, ['vMerge' => 'restart']))->addText('FREK', $headerStyle, ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
            $table->addCell(800, array_merge($headerCellStyle, ['vMerge' => 'restart']))->addText('VOL', $headerStyle, ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
            $table->addCell(800, array_merge($headerCellStyle, ['vMerge' => 'restart']))->addText('THN', $headerStyle, ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
            $table->addCell(2000, array_merge($headerCellStyle, ['gridSpan' => 3]))->addText('KONDISI', $headerStyle, ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
            $table->addCell(2500, array_merge($headerCellStyle, ['vMerge' => 'restart']))->addText('KETERANGAN', $headerStyle, ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
            $table->addCell(2000, array_merge($headerCellStyle, ['gridSpan' => 3]))->addText('INVENTARIS', $headerStyle, ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);

            // Header row 2
            $table->addRow(400);
            $table->addCell(null, array_merge($headerCellStyle, ['vMerge' => 'continue']));
            $table->addCell(null, array_merge($headerCellStyle, ['vMerge' => 'continue']));
            $table->addCell(null, array_merge($headerCellStyle, ['vMerge' => 'continue']));
            $table->addCell(null, array_merge($headerCellStyle, ['vMerge' => 'continue']));
            $table->addCell(null, array_merge($headerCellStyle, ['vMerge' => 'continue']));
            $table->addCell(600, $headerCellStyle)->addText('BB', $headerStyle, ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
            $table->addCell(600, $headerCellStyle)->addText('RR', $headerStyle, ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
            $table->addCell(600, $headerCellStyle)->addText('RB', $headerStyle, ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
            $table->addCell(null, array_merge($headerCellStyle, ['vMerge' => 'continue']));
            $table->addCell(600, $headerCellStyle)->addText('BB', $headerStyle, ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
            $table->addCell(600, $headerCellStyle)->addText('RR', $headerStyle, ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
            $table->addCell(600, $headerCellStyle)->addText('RB', $headerStyle, ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);

            // Header row 3 (numbers)
            $table->addRow(300);
            for ($i = 1; $i <= 11; $i++) {
                $table->addCell(null, $headerCellStyle)->addText((string)$i, $headerStyle, ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
            }

            // Equipment rows
            if (isset($org['equipment']) && count($org['equipment']) > 0) {
                foreach ($org['equipment'] as $idx => $eq) {
                    $table->addRow();
                    $table->addCell(null, $cellStyle)->addText($letterLabels[$idx] ?? '', $fontStyle, ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
                    $table->addCell(null, $cellStyle)->addText($eq['name'], $fontStyle);
                    $table->addCell(null, $cellStyle)->addText($eq['frequency'], $fontStyle, ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
                    $table->addCell(null, $cellStyle)->addText((string)$eq['volume'], $fontStyle, ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
                    $table->addCell(null, $cellStyle)->addText((string)$eq['year'], $fontStyle, ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
                    $table->addCell(null, $cellStyle)->addText((string)$eq['bb'], $fontStyle, ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
                    $table->addCell(null, $cellStyle)->addText((string)$eq['rr'], $fontStyle, ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
                    $table->addCell(null, $cellStyle)->addText((string)$eq['rb'], $fontStyle, ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
                    $table->addCell(null, $cellStyle)->addText($eq['notes'], $fontStyle);
                    $table->addCell(null, $cellStyle)->addText((string)$eq['bb'], $fontStyle, ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
                    $table->addCell(null, $cellStyle)->addText((string)$eq['rr'], $fontStyle, ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
                    $table->addCell(null, $cellStyle)->addText((string)$eq['rb'], $fontStyle, ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
                }

                // JML row (yellow background)
                $table->addRow();
                $table->addCell(null, $yellowCellStyle)->addText('', $fontStyle);
                $table->addCell(null, $yellowCellStyle)->addText('JML', ['bold' => true, 'size' => 9, 'name' => 'Arial']);
                $table->addCell(null, $yellowCellStyle)->addText('', $fontStyle);
                $table->addCell(null, $yellowCellStyle)->addText((string)$org['totals']['volume'], $fontStyle, ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
                $table->addCell(null, $yellowCellStyle)->addText('', $fontStyle);
                $table->addCell(null, $yellowCellStyle)->addText((string)$org['totals']['bb'], $fontStyle, ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
                $table->addCell(null, $yellowCellStyle)->addText((string)$org['totals']['rr'], $fontStyle, ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
                $table->addCell(null, $yellowCellStyle)->addText((string)$org['totals']['rb'], $fontStyle, ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
                $table->addCell(null, $yellowCellStyle)->addText('', $fontStyle);
                $table->addCell(null, $yellowCellStyle)->addText((string)$org['totals']['bb'], $fontStyle, ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
                $table->addCell(null, $yellowCellStyle)->addText((string)$org['totals']['rr'], $fontStyle, ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
                $table->addCell(null, $yellowCellStyle)->addText((string)$org['totals']['rb'], $fontStyle, ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
            }

            $section->addTextBreak();
        }

        // Save to temp file
        $tempFile = tempnam(sys_get_temp_dir(), 'data_alkom_');
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($tempFile);

        return Response::download($tempFile, 'Laporan_Data_ALKOM_' . $period['month'] . '_' . $period['year'] . '.docx')->deleteFileAfterSend(true);
    }

    private function getSiteJarkomData()
    {
        // Group sites by Organization instead of Region
        $organizations = Organization::with(['sites.towers' => function ($query) {
                $query->orderBy('repeater_type');
            }])
            ->where('is_active', true)
            ->whereHas('sites')
            ->orderBy('name')
            ->get();

        $organizationsData = $organizations->map(function (Organization $org) {
            $orgSites = $org->sites->where('is_active', true);

            $sites = $orgSites->map(function (Site $site) {
                $towers = $site->towers->map(function ($tower) {
                    return [
                        'repeater_type' => $tower->repeater_type,
                        'system' => $tower->system,
                        'frequency_rx' => $tower->frequency_rx,
                        'frequency_tx' => $tower->frequency_tx,
                        'site_status' => $tower->site_status,
                        'tower_structure' => $tower->tower_structure,
                        'tower_height' => $tower->tower_height,
                        'condition_bb' => (int) ($tower->condition_bb ?? 0),
                        'condition_rr' => (int) ($tower->condition_rr ?? 0),
                        'condition_rb' => (int) ($tower->condition_rb ?? 0),
                        'documentation' => $tower->documentation,
                        'user' => $tower->user,
                        'notes' => $tower->notes,
                        'year' => $tower->created_at ? $tower->created_at->format('Y') : '-',
                    ];
                });

                $statusCounts = collect(['POLRI', 'TELKOM', 'TVRI', 'INDOSAT'])
                    ->mapWithKeys(fn ($status) => [$status => $site->ownership == $status ? 1 : 0])
                    ->all();

                $conditionTotals = [
                    'bb' => $towers->sum('condition_bb'),
                    'rr' => $towers->sum('condition_rr'),
                    'rb' => $towers->sum('condition_rb'),
                ];

                $notes = collect([$site->description])
                    ->merge($towers->pluck('notes'))
                    ->filter()
                    ->unique()
                    ->implode(' | ');

                return [
                    'name' => $site->name,
                    'location' => $site->location,
                    'ownership' => $site->ownership,
                    'tower_height' => $site->tower_height,
                    'status_counts' => $statusCounts,
                    'towers' => $towers,
                    'volume' => $towers->count(),
                    'condition' => $conditionTotals,
                    'notes' => $notes,
                ];
            })
            ->filter(fn ($site) => $site['volume'] > 0)
            ->values();

            if ($sites->isEmpty()) {
                return null;
            }

            $statusTotals = [
                'POLRI' => $sites->sum(fn ($site) => $site['status_counts']['POLRI'] ?? 0),
                'TELKOM' => $sites->sum(fn ($site) => $site['status_counts']['TELKOM'] ?? 0),
                'TVRI' => $sites->sum(fn ($site) => $site['status_counts']['TVRI'] ?? 0),
                'INDOSAT' => $sites->sum(fn ($site) => $site['status_counts']['INDOSAT'] ?? 0),
            ];

            $conditionTotals = [
                'bb' => $sites->sum(fn ($site) => $site['condition']['bb']),
                'rr' => $sites->sum(fn ($site) => $site['condition']['rr']),
                'rb' => $sites->sum(fn ($site) => $site['condition']['rb']),
            ];

            return [
                'organization' => $org->name,
                'sites' => $sites,
                'site_count' => $sites->count(),
                'tower_count' => $sites->sum('volume'),
                'status_totals' => $statusTotals,
                'condition_totals' => $conditionTotals,
            ];
        })
        ->filter()
        ->values();

        return [
            'generated_at' => now(),
            'organizations' => $organizationsData,
            'totals' => [
                'organizations' => $organizationsData->count(),
                'sites' => $organizationsData->sum('site_count'),
                'towers' => $organizationsData->sum('tower_count'),
                'status' => [
                    'POLRI' => $organizationsData->sum(fn ($org) => $org['status_totals']['POLRI']),
                    'TELKOM' => $organizationsData->sum(fn ($org) => $org['status_totals']['TELKOM']),
                    'TVRI' => $organizationsData->sum(fn ($org) => $org['status_totals']['TVRI']),
                    'INDOSAT' => $organizationsData->sum(fn ($org) => $org['status_totals']['INDOSAT']),
                ],
                'condition' => [
                    'bb' => $organizationsData->sum(fn ($org) => $org['condition_totals']['bb']),
                    'rr' => $organizationsData->sum(fn ($org) => $org['condition_totals']['rr']),
                    'rb' => $organizationsData->sum(fn ($org) => $org['condition_totals']['rb']),
                ],
            ],
        ];
    }

    private function getInventoryData()
    {
        return [
            'total_assets' => Inventory::active()->count(),
            'by_organization' => Organization::withCount(['inventories' => function($query) {
                $query->where('is_active', true);
            }])->get(),
            'by_condition' => [
                'BB' => Inventory::active()->where('condition', 'BB')->count(),
                'RR' => Inventory::active()->where('condition', 'RR')->count(),
                'RB' => Inventory::active()->where('condition', 'RB')->count(),
            ],
            'by_year' => Inventory::active()
                ->selectRaw('installation_year, COUNT(*) as count')
                ->groupBy('installation_year')
                ->orderBy('installation_year', 'desc')
                ->get(),
        ];
    }

    private function getEquipmentTypeData()
    {
        return EquipmentType::withCount(['inventories' => function($query) {
            $query->where('is_active', true);
        }])
        ->with(['inventories' => function($query) {
            $query->where('is_active', true)
                  ->with(['organization', 'site']);
        }])
        ->get();
    }

    private function getDataAlkomData()
    {
        // Use database data only - more dynamic and accurate
        return Organization::select(['id', 'name', 'is_active'])
            ->where('is_active', true)
            ->with(['inventories' => function($query) {
                $query->select(['id', 'organization_id', 'equipment_type_id', 'installation_year', 'condition', 'quantity', 'is_active', 'unit'])
                      ->where('is_active', true)
                      ->whereHas('equipmentType', function($q) {
                          // Only ALKOM categories (exclude TOWER, SHELTER, VEHICLE, DRONE, TRUNKING)
                          $q->whereIn('category', ['REPEATER', 'RADIO FIXED', 'RADIO_FIXED', 'RADIO MOBILE', 'RADIO_MOBILE', 'HT', 'HANDY_TALKY', 'ANDROID', 'ROUTER', 'RGU']);
                      });
            }, 'inventories.equipmentType:id,name,category'])
            ->orderBy('name')
            ->get()
            ->map(function ($org) {
                return $this->mapOrganizationToAlkomFormat($org);
            })
            ->filter(function($org) {
                // Only include organizations with at least one equipment
                return isset($org['equipment']) && count($org['equipment']) > 0;
            })
            ->values(); // Re-index array
    }

    private function getFrequency($equipmentType)
    {
        // Check if equipment name contains frequency info
        $name = strtoupper($equipmentType->name ?? '');
        
        if (strpos($name, 'ANDROID') !== false) {
            return 'ANDROID';
        }
        
        // Default frequency based on category
        $category = strtoupper($equipmentType->category ?? '');
        switch($category) {
            case 'REPEATER':
            case 'RADIO_FIXED':
            case 'RADIO_MOBILE':
            case 'HANDY_TALKIE':
                return '800 MHz';
            default:
                return '800 MHz';
        }
    }

    private function mapOrganizationToAlkomFormat($org)
    {
        $equipment = [];
        $categoryLabels = ['REPEATER', 'RADIO FIXED', 'RADIO MOBILE', 'HT', 'ANDROID', 'ROUTER', 'RGU'];
        $categoryMappings = ['REPEATER', 'RADIO FIXED', 'RADIO MOBILE', 'HT', 'ANDROID', 'ROUTER', 'RGU'];

        // Group inventories by equipment category
        $equipmentGroups = $org->inventories->groupBy(function($item) {
            $category = strtoupper($item->equipmentType->category ?? 'OTHER');
            return match($category) {
                'REPEATER' => 'REPEATER',
                'RADIO FIXED', 'RADIO_FIXED' => 'RADIO FIXED', 
                'RADIO MOBILE', 'RADIO_MOBILE' => 'RADIO MOBILE',
                'HANDY_TALKY', 'HT' => 'HT',
                'ANDROID' => 'ANDROID',
                'ROUTER' => 'ROUTER',
                'RGU' => 'RGU',
                default => 'OTHER'
            };
        });

        // Initialize totals
        $totalVolume = 0;
        $totalBB = 0;
        $totalRR = 0;
        $totalRB = 0;

        foreach($categoryMappings as $index => $category) {
            $items = $equipmentGroups->get($category, collect());
            
            // Skip if no items in this category
            if ($items->isEmpty()) {
                continue;
            }
            
            $volQty = $items->sum('quantity');
            $bbQty = $items->where('condition', 'BB')->sum('quantity');
            $rrQty = $items->where('condition', 'RR')->sum('quantity');
            $rbQty = $items->where('condition', 'RB')->sum('quantity');

            // Add to totals
            $totalVolume += $volQty;
            $totalBB += $bbQty;
            $totalRR += $rrQty;
            $totalRB += $rbQty;

            // Get equipment names for notes
            $equipmentNames = $items->pluck('equipmentType.name')->unique()->take(3)->implode(', ');
            
            // Determine frequency
            $frequency = '800 MHz';
            if ($category === 'ANDROID') {
                $frequency = 'ANDROID';
            } elseif ($category === 'ROUTER' || $category === 'RGU') {
                $frequency = '-';
            }

            $equipment[] = [
                'name' => $categoryLabels[$index],
                'frequency' => $frequency,
                'volume' => $volQty > 0 ? $volQty : '-',
                'year' => $items->isNotEmpty() ? ($items->first()->installation_year ?? '-') : '-',
                'bb' => $bbQty > 0 ? $bbQty : '-',
                'rr' => $rrQty > 0 ? $rrQty : '-',
                'rb' => $rbQty > 0 ? $rbQty : '-',
                'notes' => $equipmentNames ?: '-',
                'total_volume' => $volQty > 0 ? $volQty : '-',
                'total_bb' => $bbQty > 0 ? $bbQty : '-',
                'total_rr' => $rrQty > 0 ? $rrQty : '-',
                'total_rb' => $rbQty > 0 ? $rbQty : '-',
            ];
        }

        return [
            'name' => $org->name,
            'equipment' => $equipment,
            'totals' => [
                'volume' => $totalVolume,
                'bb' => $totalBB,
                'rr' => $totalRR,
                'rb' => $totalRB,
            ]
        ];
    }


}