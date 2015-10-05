<p>
You have been registered as a voter for the "<b><?= $data->election->getTitle() ?></b>" Elections.
To access your voter's portal, open the link <a href="<?= $data->url ?>"><?= $data->url ?></a>
and enter the following details:<br><br>


<b>Voter ID:</b> <?= $data->voterId ?><br>
<b>Password:</b> <?= $data->voterPass ?><br>

</p>
