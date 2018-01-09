<?php 
session_start();
require_once('../includes/config.php');
$conn = new mysqli($CONF['host'], $CONF['user'], $CONF['pass'], $CONF['name']);
mysqli_set_charset( $conn, 'utf8');
if(isset($_REQUEST)) :
	$trackid = $_REQUEST['trackid'];
	$uid = $_REQUEST['uid'];

	$query = $conn->query("select tracks.id,tracks.title,tracks.description,tracks.uid,users.username,users.first_name,users.last_name,tracks.name,tracks.tag,tracks.art,tracks.buy,tracks.record,tracks.release,tracks.license,tracks.size,tracks.download,tracks.time,tracks.public,tracks.likes,tracks.downloads,tracks.views from tracks join users on users.idu = tracks.uid where tracks.id = '$trackid' && users.idu = '$uid'");
   $num = $query->num_rows;

    if($num >0) :

	while($row = $query->fetch_object()) :
         $row = array('username'=>$row->username,'first_name'=>$row->first_name,'last_name'=>$row->last_name,'id'=>$row->id,'title'=>html_entity_decode($row->title),'description'=>$row->description,'uid'=>$row->uid,'first_name'=>$row->first_name,'last_name'=>$row->last_name,'name'=>$row->name,'tag'=>$row->tag,'art'=>$row->art,'buy'=>$row->buy,'record'=>$row->record,'release'=>$row->release,'license'=>$row->license,'size'=>$row->size,'download'=>$row->download,'time'=>$row->time,'public'=>$row->public,'likes'=>$row->likes,'downloads'=>$row->likes,'views'=>$row->views);
		$inf['tracks'][] = $row;
		$inf['success'] = 1;
    endwhile;
	else:
		$inf['tracks'][] = 'No Tracks';
		$inf['success'] = 0;
	endif;
	

$val = json_encode($inf);
echo $val; 
endif;
?>