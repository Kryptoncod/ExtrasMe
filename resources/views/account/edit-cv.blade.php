<div class="row section-title">
  <div class="small-12 columns">
   <h2>EDITER MON CV</h2>
 </div>
</div>
<div class="details-container" style="max-height: 3000px; opacity: 1;">
  <form action="{{ route('cv_update', Auth::user()->id) }}" method="POST" data-abide id="cv-form">
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    <div class="summary-container cv-div">
      <h2>Résumé</h2>
      <textarea name="resume" placeholder="Votre résumé" rows="4" style="margin:.3125rem 0">@if(!empty($student->cv->summary)){{ $student->cv->summary }}@endif</textarea>
    </div>
    <div class="experience-container cv-div">
      <h2>Experience</h2>
      <div id="append-experience">
        @if(count($experiences) != 0)
        <?php $i=0; ?>
        @foreach($experiences as $experience)
        <?php $i++ ?>
        <input type="text" name="experience-title{{$i}}" placeholder="Titre de l'experience" class="experience-title" data-experience="{{$i}}" value="{{$experience->title}}">
        <div style="display: flex; padding: 0; border:none; margin-bottom:0;">
          <input type="text" name="experience-from{{$i}}" class="experience-from date" placeholder="Date début" style="width: 20%; margin-right:10px;" value="{{$experience->from_date->format('d/m/Y')}}">
          <input type="text" name="experience-to{{$i}}" class="experience-to date" placeholder="Date fin" style="width: 20%" value="{{$experience->to_date->format('d/m/Y')}}">
        </div>
        <textarea name="experience-description{{$i}}" class="experience-description" placeholder="Description de l'experience" rows="4" style="margin:.3125rem 0">{{$experience->summary}}</textarea>
        @if(!($i == count($experiences)))
        <hr>
        @endif
        @endforeach
        @else
        <input type="text" name="experience-title1" placeholder="Titre de l'experience" class="experience-title" data-experience="1">
        <div style="display: flex; padding: 0; border:none; margin-bottom:0;">
          <input type="text" name="experience-from1" class="experience-from date" placeholder="Date début" style="width: 20%; margin-right:10px;">
          <input type="text" name="experience-to1" class="experience-to date" placeholder="Date fin" style="width: 20%">
        </div>
        <textarea name="experience-description1" class="experience-description" placeholder="Description de l'experience" rows="4" style="margin:.3125rem 0"></textarea>
        @endif
      </div>
      <button  id="add-experience" style="width:200px; margin:auto; background-color: #222; padding :10px; margin-top: .3125rem"><i class="icon-plus-symbol" style="font-size: 10px;"></i> Ajouter une experience</button>
    </div>
    <div class="education-container cv-div">
      <h2>Education</h2>
      <div id="append-education">
        @if(count($educations) != 0)
        <?php $i=0 ?>
        @foreach($educations as $education)
        <?php $i++ ?>
        <input type="text" name="education-title{{$i}}" placeholder="Titre de l'éducation (comment on dit lol)" class="education-title" data-education="{{$i}}" value="{{$education->title}}">
        <div style="display: flex; padding: 0; border:none; margin-bottom:0;">
          <input type="text" name="education-from{{$i}}" class="education-from date" placeholder="Date début" style="width: 20%; margin-right:10px;" value="{{$education->from_date->format('d/m/Y')}}">
          <input type="text" name="education-to{{$i}}" class="education-to date" placeholder="Date fin" style="width: 20%" value="{{$education->to_date->format('d/m/Y')}}">
        </div>
        <textarea name="education-description{{$i}}" class="education-description" placeholder="Description de l'education" rows="4" style="margin:.3125rem 0">{{$education->summary}}</textarea>
        @if(!($i == count($education)))
        <hr>
        @endif
        @endforeach
        @else
        <input type="text" name="education-title1" placeholder="Titre de l'éducation (comment on dit lol)" class="education-title" data-education="1">
        <div style="display: flex; padding: 0; border:none; margin-bottom:0;">
          <input type="text" name="education-from1" class="education-from date" placeholder="Date début" style="width: 20%; margin-right:10px;">
          <input type="text" name="education-to1" class="education-to date" placeholder="Date fin" style="width: 20%">
        </div>
        <textarea name="education-description1" class="education-description" placeholder="Description de l'education" rows="4" style="margin:.3125rem 0"></textarea>
        @endif
      </div>
      <button id="add-education" style="width:200px; margin:auto; background-color: #222; padding :10px; margin-top: .3125rem"><i class="icon-plus-symbol" style="font-size: 10px;"></i> Ajouter une éducation</button>
    </div>
    <div class="skills-container cv-div">
      <h2 style="margin-bottom: 30px;">Compétences</h2>
      <ul>
        <div id="append-skill" style="display:flex; flex-wrap: wrap;">
          @if(count($skills) != 0)
          <?php $i=0 ?>
          @foreach($skills as $skill)
          <?php $i++ ?>
          <li class="li-edit-cv" style="padding:0"><input type="text" name="skill{{$i}}" placeholder="Compétence" class="competence" data-competence="{{$i}}" value="{{$skill->title}}"></li>
          @endforeach
          @else
          <li class="li-edit-cv" style="padding:0"><input type="text" name="skill1" placeholder="Compétence" class="competence" data-competence="1"></li>
          @endif
        </div>
        <button id="add-skill" style="margin:auto; margin-left:0;background-color: #222; padding :10px;"><i class="icon-plus-symbol" style="font-size: 10px;"></i></button>
      </ul>
    </div>
    <div class="languages-container cv-div">
      <h2 style="margin-bottom: 30px;">Langues</h2>
      <ul>
        <div id="append-language" style="display:flex; flex-wrap: wrap;">
          @if(count($languages) != 0)
          <?php $i=0 ?>
          @foreach($languages as $language)
          <?php $i++ ?>
          <li class="li-edit-cv" style="padding:0"><input type="text" name="language{{$i}}" placeholder="Langue" class="langue" data-langue="{{$i}}" value="{{$language->title}}"></li>
          @endforeach
          @else
          <li class="li-edit-cv" style="padding:0"><input type="text" name="language1" placeholder="Langue" class="langue" data-langue="1"></li>
          @endif
        </div>
        <button id="add-language" style="margin:auto; margin-left: 0; background-color: #222; padding :8px;"><i class="icon-plus-symbol" style="font-size: 10px;"></i></button>
      </ul>
    </div>
  </div>
  <div style="width:100%;display:flex;">
    <button type="submit" name="go-register" class="submit-account" value="Update">Update</button>
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
  </div>
</form>