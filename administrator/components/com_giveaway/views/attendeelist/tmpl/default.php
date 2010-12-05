<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

JToolBarHelper::title( 'Attendee List' );

JToolBarHelper::deleteList();
JToolBarHelper::editList();
JToolBarHelper::addNew();

?>
<form action="index.php" method="post" name="adminForm">
	<table class="adminlist">
		<thead>
			<tr>
				<th width="20">
					<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->attendee ); ?>);" />
				</th>
				<th class="title">Name</th>
				<th>Email</th>
			</tr>
		</thead>
		
		<tbody>
			<?php
			$k = 0;
			for ($i=0, $n=count( $this->attendee ); $i < $n; $i++)
			{
				$row = &$this->attendee[$i];

				$link = 'index.php?option=com_giveaway&amp;view=attendee&amp;cid[]='. $row->attendee_id;
				$checkbox = JHTML::_('grid.id', $i, $row->attendee_id );
			?>
			<tr class="<?php echo "row{$k}"; ?>">
				<td>
					<?php echo $checkbox; ?>
				</td>
				<td><a href="<?php echo $link; ?>"><?php echo $row->name ?></a></td>
				<td><?php echo $row->email ?></td>
			</tr>
			<?php
				$k = 1 - $k;
			}
			?>
		</tbody>
	</table>
	
	<input type="hidden" name="controller" value="attendeelist" />
	<input type="hidden" name="option" value="com_giveaway" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>