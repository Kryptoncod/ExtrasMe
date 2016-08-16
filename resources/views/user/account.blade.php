@extends('layouts.master', ["title" => trans('profile.title.student', ["name" => $user->username]), "footer" => false])
@section('content')

  <div class="row collapse profile profile-container">
    @include('user.sidebar')
    
    @if(Auth::user()->type == 0)
      <div class="medium-10 small-12 columns panel-main">
        @if(Session::has('message'))
          @if(count($errors) > 0)
            <div class="erreur-update" style="background-color: #960E0E;">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</div>
          @elseif(Session::get('message') != "")
            <div class="erreur-update" style="background-color: #00B143;">{{Session::get('message')}}</div>
          @else
             <div class="erreur-update" style="background-color: #960E0E;">Vous devez importer les 3 fichiers pour que les modifications soient prises en compte.</div>
          @endif
        @endif
        <div class="row section-title" style="margin-top:0px;">
          <div class="small-12 columns">
            <h2>S'ENREGISTRER</h2>
          </div>
        </div>
        @if(!$student->registration_done)
        <div class="row register-form-container">
          <form method="POST" action="{{ route('register_update' , Auth::user()->id) }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="file-container">
              @if(session()->has('error'))
                <div>{!! session('error') !!}</div>
              @endif
              <input type="file" name="carte-id" id="id-file" class="input-file">
              <div class="fake-input-file">
                <div class="cross-container" id="cross-cont1">
                  <i class="icon-plus-symbol" id="cross1"></i>
                </div>
                <div class="file-label" id="id-label">
                  <label>Carte d'identité</label>
                </div>
              </div>
            </div>
            <div class="file-container">
             <input type="file" name="avs" id="avs-file" class="input-file">
             <div class="fake-input-file">
                <div class="cross-container" id="cross-cont2">
                  <i class="icon-plus-symbol" id="cross2"></i>
                </div>
                <div class="file-label" id="avs-label"><label>Carte AVS</label></div>
              </div>
            </div>
            <div class="file-container">
             <input type="file" name="permit" id="permit-file" class="input-file">
              <div class="fake-input-file">
                <div class="cross-container" id="cross-cont3">
                  <i class="icon-plus-symbol" id="cross3"></i>
                </div>
                <div class="file-label" id="permit-label"><label>Permis de travail</label></div>
              </div>
            </div>
            <div style="width:100%;display:flex;">
              <input type="submit" name="go-register" class="submit-account" value="Update">
            </div>
          </form>
        </div>
        @else
          <div style="width: 70%; display: flex; justify-content:center; flex-direction:column; margin:auto;">
            <h3 style="color: white;margin:auto;">Vous avez déjà importé les fichiers necessaires pour contacter des professionnels.</h3>
            <a href="{{ route('modif_files' , Auth::user()->id) }}" style="margin:auto; margin-top: 20px;" id="modif-files"><button  style="width:300px;  background-color: #222; padding :10px; ">Modifier mes fichiers importés</button></a>
          </div>
        @endif
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
                <button  id="add-experience" style="width:30%; margin:auto; background-color: #222; padding :10px; margin-top: .3125rem"><i class="fa fa-plus" aria-hidden="true" id="cross3"></i> Ajouter une experience</button>
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
                <button id="add-education" style="width:30%; margin:auto; background-color: #222; padding :10px; margin-top: .3125rem"><i class="fa fa-plus" aria-hidden="true" id="cross3"></i> Ajouter une éducation</button>
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
                <button id="add-skill" style="margin:auto; margin-left:0;background-color: #222; padding :10px;"><i class="fa fa-plus" aria-hidden="true" id="cross3"></i></button>
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
                <button id="add-language" style="margin:auto; margin-left: 0; background-color: #222; padding :8px;"><i class="fa fa-plus" aria-hidden="true" id="cross3"></i></button>
              </ul>
            </div>
          </div>
            <div style="width:100%;display:flex;">
              <button type="submit" name="go-register" class="submit-account" value="Update">Update</button>
              <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
            </div>
          </form>
        <div class="row section-title">
          <div class="small-12 columns">
            <h2>EDITER MON PROFIL</h2>
          </div>
        </div>
        <div style="display:flex; width: 70%; margin:auto;">
          <form style="width:100%;" data-abide action="{{ route('profile_update', Auth::user()->id) }}" method="POST">
          <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
            <div>
              <label for="name">FIRST NAME : </label><input type="text" name="first-name" value="{{$student->first_name}}" required pattern="[a-zA-Z]+">
              <small class="error">First name is required and must contain only alphanumerics characters.</small>
            </div>
            <div>
              <label for="name">LAST NAME : </label><input type="text" name="last-name" value="{{$student->last_name}}" required pattern="[a-zA-Z]+">
              <small class="error">Last name is required and must contain only alphanumerics characters.</small>
            </div>
            <div>
              <label for="email">EMAIL : </label><input type="text" name="email" value="{{$user->email}}" required pattern=".+@ehl.ch$">
              <small class="error">Email is required and must end with @ehl.ch.</small>
            </div>
            <div>
              <label for="number">CONTACT NUMBER : </label><input type="text" name="phone" value="{{$student->phone}}" required pattern="[1-9]+">
              <small class="error">Contact number is required and must be valid</small>
            </div>
            <div id="next-to-password">
              <label for="year">YEAR : </label><select name="school_year">
                   <option selected disabled value="">{{$student->school_year}}</option>
                   @foreach(config('international.ehl_years') as $id => $year)
                      <option value="{{ $id }}">{{ $year }}</option>
                   @endforeach
                </select>
                <small class="error">EHL's year is required.</small>
            </div>
            <div id="change-password-div">
              <button style="padding:10px; margin:10px auto 0px auto; background-color:#222;" id="change-password">Modifier mon mot de passe</button>
            </div>
            <div style="width:100%;display:flex; margin-top:10px; margin-bottom: 30px;">
              <input type="submit" name="go-register" class="submit-account" value="Update">
            </div>
          </form>
        </div>
      </div>
    @elseif(Auth::user()->type == 1)
      <div class="medium-10 small-12 columns panel-main">
        <div class="row section-title">
          <div class="small-12 columns">
             <h2>EDITER MA DESCRITPION</h2>
          </div>
        </div>

        <div class="details-container" style="max-height: 3000px; opacity: 1;">
          <form action="{{ route('description_update', Auth::user()->id) }}" method="POST" data-abide id="cv-form">
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
            <div class="summary-container cv-div">
              <h2>Description</h2>
                <textarea name="description" placeholder="Votre description" rows="4" style="margin:.3125rem 0">@if(!empty($professional->description)){{ $professional->description }}@endif</textarea>
            </div>
            <div style="width:100%;display:flex;">
              <button type="submit" name="go-register" class="submit-account" value="Update">Update</button>
              <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
            </div>
          </form>
        </div>
      </div>
    @endif
  </div>

@endsection