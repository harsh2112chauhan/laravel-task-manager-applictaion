Dear {{$data->task_owner}},<br><br>

The task {{$data->task_description}},<br><br>{{$data->status ==0 ?"has been added for you":"Has been marked as Done"}}
@if($data->status==0)
Kindly Complete it within {{$data->task_eta}},<br><br>
@endif

Thank You