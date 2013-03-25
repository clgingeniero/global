<?php
/**
 * @category   MathieuF
 * @package    MathieuF_EventsCalendar
 * @author     Mathieu Fortin <mathieu@calinsetpopotin.com>
 */
class MathieuF_EventsCalendar_Adminhtml_EventController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->loadLayout();

        $this->_setActiveMenu('cms/mathieufeventscal');
        $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Events Calendar'), Mage::helper('adminhtml')->__('Events Calendar'));
        $this->_addContent($this->getLayout()->createBlock('mathieufeventscal/adminhtml_event'));

        $this->renderLayout();
    }

    public function editAction()
    {
        $this->loadLayout();

        $this->_setActiveMenu('cms/mathieufeventscal');
        $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Events Calendar'), Mage::helper('adminhtml')->__('Events Calendar'));

        $this->_addContent($this->getLayout()->createBlock('mathieufeventscal/adminhtml_event_edit'))
            ->_addLeft($this->getLayout()->createBlock('mathieufeventscal/adminhtml_event_edit_tabs'));
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->editAction();
    }

    public function saveAction()
    {
        if ( $this->getRequest()->getPost() ) {
            try {
                $model = Mage::getModel('mathieufeventscal/event')
                    ->setId($this->getRequest()->getParam('id'))
                    ->setTitle($this->getRequest()->getParam('title'))
                    ->setDetails($this->getRequest()->getParam('details'))
                    ->setStoreId($this->getRequest()->getParam('store_id'))
                    ->setUrl($this->getRequest()->getParam('url'));

                    $timezone= Mage_Core_Model_Locale::DEFAULT_TIMEZONE;//Mage::getStoreConfig('mathieufeventscal/general/timezone');

                    $oldzone = @date_default_timezone_get();
                    $result = date_default_timezone_set($timezone);

                    if ($result === true) {
                        $datefrom = strtotime($this->getRequest()->getParam('date_from'));
                        $datetime = date("Y-m-d-H-i",$datefrom);
                        $datetime = str_replace(array(" ",":"),"-",$datetime);
                        $datetime = explode("-",$datetime);
                        $offset_from = gmmktime($datetime[3], $datetime[4], 0, $datetime[1], $datetime[2], $datetime[0]) - mktime($datetime[3], $datetime[4], 0, $datetime[1], $datetime[2], $datetime[0]);
                        $dateto = strtotime($this->getRequest()->getParam('date_to'));
                        $datetime = date("Y-m-d-H-i",$dateto);
                        $datetime = str_replace(array(" ",":"),"-",$datetime);
                        $datetime = explode("-",$datetime);
                        $offset_to = gmmktime($datetime[3], $datetime[4], 0, $datetime[1], $datetime[2], $datetime[0]) - mktime($datetime[3], $datetime[4], 0, $datetime[1], $datetime[2], $datetime[0]);
                    }

                    date_default_timezone_set($oldzone);

                    $format = Mage::app()->getLocale()->getDateTimeFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT);

                    if ($this->getRequest()->getParam('date_from')) {
                        $date = Mage::app()->getLocale()->date($this->getRequest()->getParam('date_from'), $format);
                        $time = $date->getTimestamp() - $offset_from;
                        $model->setDateFrom(Mage::getModel('core/date')->date(null, $time));
                    } else {
                        $model->setDateFrom(null);
                    }
                    if ($this->getRequest()->getParam('date_to')) {
                        $date = Mage::app()->getLocale()->date($this->getRequest()->getParam('date_to'), $format);
                        $time = $date->getTimestamp() - $offset_to;
                        $model->setDateTo(Mage::getModel('core/date')->date(null, $time));
                    } else {
                        $model->setDateTo(null);
                    }
                    $model->save();

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Event was successfully saved'));

                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        $this->_redirect('*/*/');
    }

    public function deleteAction()
    {
        if( $this->getRequest()->getParam('id') > 0 ) {
            try {
                $model = Mage::getModel('mathieufeventscal/event');
                /* @var $model Mage_Rating_Model_Rating */
                $model->setId($this->getRequest()->getParam('id'))
                    ->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Event was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }

    protected function _isAllowed()
    {
	    return Mage::getSingleton('admin/session')->isAllowed('cms/mathieufeventscal');
    }

}
