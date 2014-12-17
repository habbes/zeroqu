<?php 

if($data->election->isOngoing()){
?>

<p>
The voting process is ongoing. You can vote for your candidates by opening their respective
Position's link under the Vote menu.
</p>

<?php 
}
else if($data->election->isPending()) {
?>

<p>
The voting process has not yet begun. You can view the candidates by opening the Candidates menu.
</p>

<?php 

}
else if($data->election->hasEnded()) {
?>
<p>
The voting process has ended. You can view the candidates but you cannot cast a vote.
</p>
<?php 
}
?>
