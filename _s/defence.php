<?

// ��� ����� ������ �� ���� �� ����

function defender_xss($arr){
    //$filter = array("<", ">"); 
    $filter = array("<", ">","="," (",")",";"); // ,"/"
     foreach($arr as $num => $xss){
        $arr[$num]=str_replace ($filter, "|", $xss);
     }
       return $arr;
}
//�����������  ������� ����� ���������� �������� ������:
$_REQUEST=defender_xss($_REQUEST);