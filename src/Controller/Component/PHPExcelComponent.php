<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use PHPExcel;
use PHPExcel\IOFactory;

class PHPExcelComponent extends Component {
	
//	public function initialize(array $config) {
//		parent::initilalize($config);
//		$this->controller = $this->_registry->getController();
//	}
	
	public function export($data = [], $sheetName = 'TestSheet', $excelName = 'TestExcel') {
		//Create new PHPExcel Object
		$excelObj = new PHPExcel();
	
		//Setting metadata
		$excelObj->getProperties()
				 ->setCreator("Administrator")
				 //->setLastModifiedBy("Administrator")
				 ->setTitle($sheetName)
				 //->setSubject("PHPExcel Test Subject")
				 //->setDescription("Test document for PHPExcel, generated using PHP classes.")
				 //->setKeywords("PHPExcel Keywords")
				 ->setCategory("PHPExcel Category");	
					
		//Write data and set property to Excel
		$activeSheet = $excelObj->getActiveSheet();
		$activeSheet->fromArray($data);
		$activeSheet->setTitle($sheetName);
		$activeSheet->setAutoFilter($activeSheet->calculateWorksheetDimension());
		
		//解决IE下文件名乱码问题
		$ua = $_SERVER['HTTP_USER_AGENT'];
		$ua = strtolower($ua);
		if(preg_match('/msie/', $ua) || preg_match('/edge/', $ua)) {
			$excelName = str_replace('+', '%20', urlencode($excelName)); 
		}
		
		//Redirect output to a client’s web browser (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header("Content-Disposition: attachment;filename= '{$excelName}.xlsx'");
		header('Cache-Control: max-age=0');
		
		//下载到客户端
		$objWriter = \PHPExcel_IOFactory::createWriter($excelObj, 'Excel2007');
		$objWriter->save('php://output');
		
		exit;
	}
}