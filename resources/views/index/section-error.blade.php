@extends('index.section', ['number' => 5, 'id' => 'home'])
@section('section-content')

   <div class="error404-container">
      <h1>SORRY, THE PAGE THAT YOU ARE LOOKING FOR IS CURRENTLY NOT AVAILABLE</h1>
      <h4>WHAT ARE YOU LOOKING FOR ?</h4>
      <div class="search-bar">
         <label for="search"><i class="icon-search"></i></label>
         <form action="" method="GET">
            <input type="search" name="searchFav" id="search">
         </form>
      </div>
      <h4 style="margin-bottom:0;">OR <a href="">CLICK HERE</a> TO RETURN TO HOMEPAGE</h4>
   </div>
   

@overwrite