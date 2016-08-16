<div class="row section-title" style="margin-top:0px;">
  <div class="small-12 columns">
    <h2>S'ENREGISTRER</h2>
  </div>
</div>
<div style="width: 70%; display: flex; justify-content:center; flex-direction:column; margin:auto;">
	<h3 style="color: white;margin:auto; text-align: center;">Vous avez déjà importé les fichiers necessaires pour contacter des professionnels.</h3>
	<a href="{{ route('modif_files' , Auth::user()->id) }}" style="margin:auto; margin-top: 20px;" id="modif-files"><button  style="width:300px;  background-color: #222; padding :10px; ">Modifier mes fichiers importés</button></a>
</div>