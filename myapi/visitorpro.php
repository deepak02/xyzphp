<?php 
require_once('../includes/config.php');
$conn = new mysqli($CONF['host'], $CONF['user'], $CONF['pass'], $CONF['name']);
mysqli_set_charset( $conn, 'utf8');
if($_REQUEST['visitertracks']=='tracks' && $_REQUEST['requestid']!='') :
           $requestid = $_REQUEST['requestid'];
		   mysqli_set_charset( $conn, 'utf8');
             $query = $conn->query("select  users.first_name,users.last_name,tracks.*  from tracks join users on users.idu = tracks.uid where tracks.uid = '$requestid' order by tracks.id desc");
            $num = $query->num_rows;
           if($num >0) :
                      while($row = $query->fetch_object()) :
                       $row = array('first_name'=>$row->first_name,'last_name'=>$row->last_name,'id'=>$row->id,'title'=>html_entity_decode($row->title),'description'=>$row->description,'uid'=>$row->uid,'first_name'=>$row->first_name,'last_name'=>$row->last_name,'name'=>$row->name,'tag'=>$row->tag,'art'=>$row->art,'buy'=>$row->buy,'record'=>$row->record,'release'=>$row->release,'license'=>$row->license,'size'=>$row->size,'download'=>$row->download,'time'=>$row->time,'public'=>$row->public,'likes'=>$row->likes,'downloads'=>$row->likes,'views'=>$row->views);
                               $set['tracks'][] = $row;
                              $set['success'] =1;
                     endwhile;
          else : 
                 $set['tracks'][] = 'No-Tracks';
                $set['success']=0;
         endif;
elseif($_REQUEST['trackslike']=='likes' && $_REQUEST['requestid']!='') :
$requestid = $_REQUEST['requestid'];
mysqli_set_charset( $conn, 'utf8');
$query = $conn->query("select DISTINCT tracks.* from likes join tracks on tracks.id = likes.track where likes.by='$requestid'");
      $num = $query->num_rows;
           if($num >0) :
                      while($row = $query->fetch_assoc()) :
                               $set['liketracks'][] = $row;
                              $set['success'] =1;
                     endwhile;
          else : 
                 $set['liketracks'][] = 'No-Tracks';
                $set['success']=0;
         endif;
else :
$visiter_id = $_REQUEST['vid'];

$followings = $conn->query("SELECT count(relations.subscriber) as following FROM `relations`,`users` WHERE `users`.`idu` = `relations`.`leader` AND `relations`.`subscriber` = '$visiter_id'");

$followers = $conn->query("SELECT count(relations.subscriber) as follower FROM `relations`,`users` where `users`.`idu`= `relations`.`subscriber` AND `relations`.`leader` = '$visiter_id'");  

$tracklikes = $conn->query("SELECT count(likes.by) as likes FROM `likes`,`tracks` WHERE `tracks`.`id` = `likes`.`track` AND `likes`.`by` = '$visiter_id'");

$query = $conn->query("select users.*,count(tracks.uid) as totaltracks from users left join tracks on tracks.uid=users.idu  where users.idu = '$visiter_id'");
$num = $query->num_rows;
if($num > 0) :
  while($row = $query->fetch_assoc()):
         $follower  = $followers->fetch_assoc();   
         $following = $followings->fetch_assoc();
         $tracklike = $tracklikes->fetch_assoc();
           $set['search'][] = array_merge($row,$follower,$following,$tracklike);
          $set['success'] = 1;
 endwhile;
else :
          $set['search'][] = "Invalid User";
          $set['success'] = 0;
endif;
endif;
$val = json_encode($set);
echo $val;
?>