<?php

use ExcelAnt\Adapter\PhpExcel\Workbook\Workbook,
    ExcelAnt\Adapter\PhpExcel\Sheet\Sheet,
    ExcelAnt\Adapter\PhpExcel\Writer\Writer,
    ExcelAnt\Table\Table,
    ExcelAnt\Coordinate\Coordinate;

use ExcelAnt\Adapter\PhpExcel\Writer\WriterFactory,
    ExcelAnt\Adapter\PhpExcel\Writer\PhpExcelWriter\Excel5;


class Export extends Eloquent
{
    public static function createExport($posts)
    {
        $workbook = new Workbook();
        $sheet = new Sheet($workbook);
        $table = new Table();

        foreach ($posts as $post) {
            $table->setRow([
                $post->first_name.' '.$post->last_name,
            ]);
        }

        $sheet->addTable($table, new Coordinate(2, 2));
        $workbook->addSheet($sheet);
        $writer = (new WriterFactory())->createWriter(new Excel5('/public/excel/posts.xls'));
        $phpExcel = $writer->convert($workbook);
        $writer->write($phpExcel);
    }
}