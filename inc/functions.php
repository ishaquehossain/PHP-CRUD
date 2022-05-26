<?php 

define('DB_NAME', '..\crud\inc\data\db.txt'); //https://www.w3schools.com/php/func_misc_define.asp

function seed(){
	$data= 
	array (

					array(
						  'id'=>1,	
						  'fname'=>'Ishaque',
						  'lname'=>'Hossain',
						  'roll'=>1

					),

					array(
						  'id'=>2,	
						  'fname'=>'abudullah',
						  'lname'=>'mamun',
						  'roll'=>4

					),
					array(
						  'id'=>3,	
						  'fname'=>'Joy',
						  'lname'=>'Prakesh',
						  'roll'=>3

					),
					array(
						  'id'=>4,	
						  'fname'=>'akm',
						  'lname'=>'saiede',
						  'roll'=>6

					)
		  );
	$serializeData= serialize($data);
	file_put_contents(DB_NAME, $serializeData, LOCK_EX);

	
}
function generatereport (){
	$serializeData=file_get_contents(DB_NAME);
	$students=unserialize($serializeData);
	
	?>
	  <table>
        <tr>
            <th>Name</th>
            <th>Roll</th>
            <th width="25%">Action</th>
        </tr>
        <?php
        foreach ( $students as $student ) {
            ?>
            <tr>
                <td><?php printf( '%s %s', $student['fname'], $student['lname'] ); ?></td>
                <td><?php printf( '%s', $student['roll'] ); ?></td>
                <td><?php printf( '<a href="..\crud\index.php?task=edit&id=%s">Edit</a> | <a class="delete" href="..\crud\index.php?task=delete&id=%s">Delete</a>',$student['id'],$student['id'] ); ?></td>
            </tr>
            <?php
        }
      } ?>
       

    </table>


    <?php
    function addStudent($fname, $lname,$roll){
    	$found=false;
    	$serializeData=file_get_contents(DB_NAME);
		$students=unserialize($serializeData);
		foreach ($students as $_student) {

			if ($_student['roll']==$roll) {
				$found= true;
				break;
			}
		}
		if (!$found) {
			
		//$newId= count($students) +1;
		$newId= getnewId($students);

		$student=  array(
			'id' =>$newId ,
			'fname' =>$fname ,
			'lname' =>$lname ,
			'roll' =>$roll 
			);

		array_push($students, $student);
		$serializeData= serialize($students);
	    file_put_contents(DB_NAME, $serializeData, LOCK_EX);
	    return true;
		}
		return false;
	}


	 function getStudent($id){
    	$found=false;
    	$serializeData=file_get_contents(DB_NAME);
		$students=unserialize($serializeData);
		foreach ($students as $student) {

			if ($student['id']==$id) {
				return $student;
			}
		}
		return false;

	}


	function updateStudent($id,$fname,$lname,$roll){
		$found=false;
		$serializeData=file_get_contents(DB_NAME);
		$students=unserialize($serializeData);

		foreach ($students as $_student) {

			if ($_student['roll']==$roll && $_student['id']!=$id) {
				$found= true;
				break;
			}
		}

		if(!$found){
		$students[$id-1]['fname']=$fname;
		$students[$id-1]['lname']=$lname;
		$students[$id-1]['roll']=$roll;
		$serializeData= serialize($students);
		file_put_contents(DB_NAME, $serializeData, LOCK_EX);
		return true;
		
		}

		return false;
	}

	function deleteStudent($id){
		$serializeData=file_get_contents(DB_NAME);
		$students=unserialize($serializeData);

		//unset($students[$id-1]);
		$i=0;
		foreach ($students as $student) {

			if ($student['id']==$id) {
				unset($students[$i]);
				
			}
			$i++;
		}

		$serializeData= serialize($students);
		file_put_contents(DB_NAME, $serializeData, LOCK_EX);
	}

	function printRaw(){
		$serializeData=file_get_contents(DB_NAME);
		$students=unserialize($serializeData);
		print_r($students);

	}

	function getnewId($students){
		$maxId=max(array_column($students, 'id'));
		return $maxId+1;

	}

	


?>