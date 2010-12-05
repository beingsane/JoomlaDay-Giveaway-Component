<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

class GiveawayControllerAttendeelist extends JController
{	
	public function add()
	{
		JRequest::setVar('view', 'attendee');
		$this->display();
	}
	
	public function edit()
	{
		JRequest::setVar('view', 'attendee');
		$this->display();
	}
	
	public function save()
	{
		JRequest::checkToken() or jexit( 'Invalid Token' );
	
		$post = JRequest::get( 'post' );
	
		$model = $this->getModel('attendeelist');
		$model->save($post);
	
		$this->setRedirect( 'index.php?option=com_giveaway&controller=attendeelist', 'Attendee Saved' );
	}
	
	public function remove()
	{
		JRequest::checkToken() or jexit( 'Invalid Token' );
	
		$cid = JRequest::getVar('cid', array(0));
		JArrayHelper::toInteger( $cid );
		$row =& JTable::getInstance('giveaway_attendee', 'Table');
	
		foreach ($cid as $id) {
			if (!$row->delete($id)) {
				return JError::raiseWarning( 500, $row->getError() );
			}
		}
	
		// Some pluralization, you may need to change this for your purposes
		$s = '';
	
		if (count($cid) > 1) {
			$s = 's';
		}
	
		$this->setRedirect( 'index.php?option=com_giveaway&controller=attendeelist', "Attendee{$s} Deleted" );
	}
	
	function display()
	{
		$view = JRequest::getVar('view', '');
		
		if ($view == '') {
			JRequest::setVar('view', 'attendeelist');
		}
		
		parent::display();
	}
}
