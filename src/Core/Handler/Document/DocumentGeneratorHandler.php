<?php

namespace Debishev\Bitrix24Library\Core\Handler\Document;


use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\Element\TextRun;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\SimpleType\TblWidth;
use PhpOffice\PhpWord\TemplateProcessor;
use Symfony\Component\Filesystem\Filesystem;

class DocumentGeneratorHandler
{
    private string $templatePath = '';
    public string $generatedPath = '';
    private Filesystem $filesystem;
    public string $newFilename = '';

    public function __construct(string $projectDir, )
    {
        $this->filesystem = new Filesystem();
        $this->templatePath = $projectDir.'/documents/templates/';
        $this->generatedPath = $projectDir.'/var/generated/cache/';
    }

    public function generateWordDocumentFromTemplate(array $params, string $template, string $newFilename): string {







        $newFilepath = $this->copyTemplateToGenerate($template,$newFilename);
        $mArray = explode('/', $newFilepath);
        $this->newFilename = end($mArray);
        $wordApi = new TemplateProcessor($newFilepath);





        foreach ($params as $key => $value) {




            if (gettype($value) == 'array') {

                if ($key == 'tables') {


                    foreach ($value as $tblKey => $row) {
                        $table = new Table(['borderSize' => 2, 'borderColor' => 'black', 'width' => 9050, 'unit' => TblWidth::TWIP]);
                        foreach ($row as $rowKey => $rowValue) {
                            $table->addRow();
                            foreach ($rowValue as $cellKey => $cellValue) {
                                $table->addCell(1000)->addText($cellValue);
                            }
                        }
                        $wordApi->setComplexBlock($tblKey, $table);
                    }
                    unset($params[$key]);
                } else {
                    $textrun = new TextRun();
                    $textrun->addText(implode(',', $value));
                    $textrun->addTextBreak();
                    unset($params[$key]);
                    $wordApi->setComplexValue($key,$textrun);
                }





            }






        }






//
//        $document_with_table = new PhpWord();
//        $section = $document_with_table->addSection();
//        $table = $section->addTable();











        $wordApi->setValues($params);





        $wordApi->saveAs($newFilepath);
        $list [] = $newFilepath;
        return $newFilepath;
    }



    private function copyTemplateToGenerate(string $templateName, string $newTemplateName): string {
        $extension = $this->getFileExtension($templateName);
        $this->filesystem->copy($this->templatePath.$templateName,$this->generatedPath.$newTemplateName.'.'.$extension, true);
        return $this->generatedPath.$newTemplateName.'.'.$extension;
    }

    private function getFileExtension(string $filepath): string {
        return pathinfo($filepath)['extension'];
    }



}