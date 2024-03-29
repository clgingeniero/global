<?php

class Kreativkonzentrat_Glossary_Adminhtml_GlossaryController extends Mage_Adminhtml_Controller_Action {

	protected function _initAction() {
		$this->loadLayout()
				->_setActiveMenu('glossary/items')
				->_addBreadcrumb(Mage::helper('adminhtml')->__('Items Manager'), Mage::helper('adminhtml')->__('Item Manager'));

		return $this;
	}

	public function indexAction() {
		$this->_initAction()->renderLayout();
	}

	public function editAction() {
		$id = $this->getRequest()->getParam('id');
		$model = Mage::getModel('glossary/glossary')->load($id);

		if ($model->getId() || $id == 0) {
			$data = Mage::getSingleton('adminhtml/session')->getFormData(true);
			if (!empty($data)) {
				$model->setData($data);
			}

			Mage::register('glossary_data', $model);

			$this->loadLayout();
			$this->_setActiveMenu('glossary/items');

			$this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
			$this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));

			$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

			$this->_addContent($this->getLayout()->createBlock('glossary/adminhtml_glossary_edit'))
					->_addLeft($this->getLayout()->createBlock('glossary/adminhtml_glossary_edit_tabs'));

			$this->renderLayout();
		} else {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('glossary')->__('Item does not exist'));
			$this->_redirect('*/*/');
		}
	}

	public function newAction() {
		$this->_forward('edit');
	}

	public function saveAction() {
		if ($data = $this->getRequest()->getPost()) {

			if (isset($_FILES['filename']['name']) && $_FILES['filename']['name'] != '') {
				try {
					/* Starting upload */
					$uploader = new Varien_File_Uploader('filename');

					// Any extension would work
					$uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png'));
					$uploader->setAllowRenameFiles(false);

					// Set the file upload mode 
					// false -> get the file directly in the specified folder
					// true -> get the file in the product like folders 
					//	(file.jpg will go in something like /media/f/i/file.jpg)
					$uploader->setFilesDispersion(false);

					// We set media as the upload dir
					$path = Mage::getBaseDir('media') . DS;
					$uploader->save($path, $_FILES['filename']['name']);
				} catch (Exception $e) {
					
				}

				//this way the name is saved in DB
				$data['filename'] = $_FILES['filename']['name'];
			}
			$stores		= $this->getRequest()->getPost('stores', false);
			//fix for "all storeviews"
			$storeIds	= array();
			if($stores[0] == '0'){
				$data['stores'] = array('0');
			}

			$model = Mage::getModel('glossary/glossary');
			$model->setData($data)
					->setId($this->getRequest()->getParam('id'));

			try {
				if ($model->getCreatedTime == NULL || $model->getUpdateTime() == NULL) {
					$model->setCreatedTime(now())
							->setUpdateTime(now());
				} else {
					$model->setUpdateTime(now());
				}
				$title = $data['title'];
				$title2 = utf8_decode($data['title']);
				$title = utf8_encode($title2[0]);

				function testF($title) {
					if (preg_match('/^[a-z]$/i', $title)) {
						return strtoupper($title);
					}

					switch ($title) {
						case 'ä': case 'Ä':
							return 'A';
						case 'ö': case 'Ö':
							return 'O';
						case 'ü': case 'Ü':
							return 'U';
						default:
							return '123';
					}
				}

				$model->setLetter(testF($title));
				$model->save();
				//TODO:
				//Mage::app()->cleanCache();
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('glossary')->__('Item was successfully saved'));
				Mage::getSingleton('adminhtml/session')->setFormData(false);

				if ($this->getRequest()->getParam('back')) {
					$this->_redirect('*/*/edit', array('id' => $model->getId()));
					return;
				}
				$this->_redirect('*/*/');
				return;
			} catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				Mage::getSingleton('adminhtml/session')->setFormData($data);
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
				return;
			}
		}
		Mage::getSingleton('adminhtml/session')->addError(Mage::helper('glossary')->__('Unable to find item to save'));
		$this->_redirect('*/*/');
	}

	public function deleteAction() {
		if ($this->getRequest()->getParam('id') > 0) {
			try {
				$model = Mage::getModel('glossary/glossary');

				$model->setId($this->getRequest()->getParam('id'))
						->delete();

				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully deleted'));
				$this->_redirect('*/*/');
			} catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
			}
		}
		$this->_redirect('*/*/');
	}

	public function massDeleteAction() {
		$glossaryIds = $this->getRequest()->getParam('glossary');
		if (!is_array($glossaryIds)) {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select item(s)'));
		} else {
			try {
				foreach ($glossaryIds as $glossaryId) {
					$glossary = Mage::getModel('glossary/glossary')->load($glossaryId);
					$glossary->delete();
				}
				Mage::getSingleton('adminhtml/session')->addSuccess(
						Mage::helper('adminhtml')->__('Total of %d record(s) were successfully deleted', count($glossaryIds))
				);
			} catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
			}
		}
		$this->_redirect('*/*/index');
	}

	public function massStatusAction() {
		$glossaryIds = $this->getRequest()->getParam('glossary');
		if (!is_array($glossaryIds)) {
			Mage::getSingleton('adminhtml/session')->addError($this->__('Please select item(s)'));
		} else {
			try {
				foreach ($glossaryIds as $glossaryId) {
					$glossary = Mage::getSingleton('glossary/glossary')
							->load($glossaryId)
							->setStatus($this->getRequest()->getParam('status'))
							->setIsMassupdate(true)
							->save();
				}
				$this->_getSession()->addSuccess($this->__('Total of %d record(s) were successfully updated', count($glossaryIds)));
			} catch (Exception $e) {
				$this->_getSession()->addError($e->getMessage());
			}
		}
		$this->_redirect('*/*/index');
	}

	public function exportCsvAction() {
		$fileName = 'glossary.csv';
		$content = $this->getLayout()->createBlock('glossary/adminhtml_glossary_grid')
				->getCsv();
		$this->_sendUploadResponse($fileName, $content);
	}

	public function exportXmlAction() {
		$fileName = 'glossary.xml';
		$content = $this->getLayout()->createBlock('glossary/adminhtml_glossary_grid')
				->getXml();
		$this->_sendUploadResponse($fileName, $content);
	}

	protected function _sendUploadResponse($fileName, $content, $contentType='application/octet-stream') {
		$response = $this->getResponse();
		$response->setHeader('HTTP/1.1 200 OK', '');
		$response->setHeader('Pragma', 'public', true);
		$response->setHeader('Cache-Control', 'must-revalidate, post-check=0, pre-check=0', true);
		$response->setHeader('Content-Disposition', 'attachment; filename=' . $fileName);
		$response->setHeader('Last-Modified', date('r'));
		$response->setHeader('Accept-Ranges', 'bytes');
		$response->setHeader('Content-Length', strlen($content));
		$response->setHeader('Content-type', $contentType);
		$response->setBody($content);
		$response->sendResponse();
		die;
	}

}