@extends('admin.layout.main')
@section('title','Vehicle Photo')
@section('content')
<div class="site-content">
  <div class="content-area py-1">
    <div class="container-fluid"> 
     <div class="container">
        <?php
             $url=$link;
            $id='';
            if (isset($id)) {
               $pos = strrpos($url, '/');
               $id = $pos === false ? $url : substr($url, $pos + 1);
               $id = strtr ($id, array ('?usp=sharing' => ''));
          ?>  
        <iframe src="https://drive.google.com/embeddedfolderview?id={{ $id }}#grid" style="width:100%; height:800px; border:0;"></iframe>
        <?php } else { ?>

          <h2 style="text-align: center;">Sorry no Image for this vehicle</h2>
         <?php } ?>
           

     </div>
   </div>
 </div>
</div>
@endsection