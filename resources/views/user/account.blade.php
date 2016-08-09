@extends('layouts.master', ["title" => trans('profile.title.student', ["name" => $user->username]), "footer" => false])
@section('content')

  <div class="row collapse profile profile-container">
    @include('user.sidebar', ['nav' => ['MY PAST EXPERIENCE' => ''], 'formType' => 0])

    <div class="medium-10 small-12 columns panel-main">

      <div class="row section-title">
        <div class="small-12 columns">
          <h2>S'ENREGISTRER</h2>
        </div>
<<<<<<< HEAD
      </div>

      <div class="row register-form-container">
        <form method="POST" action="{{ route('register_update' , Auth::user()->id) }}">
          <div class="file-container">
            <input type="file" name="cv" id="id-file" class="input-file">
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
           <input type="file" name="lettre" id="avs-file" class="input-file">
           <div class="fake-input-file">
              <div class="cross-container" id="cross-cont2">
                <i class="icon-plus-symbol" id="cross2"></i>
=======
        <div class="row register-form-container">
          <form method="POST" action="{{ route('register_update' , Auth::user()->id) }}" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
            <div class="file-container">
                 <input type="file" name="carte-id" id="id-file" class="input-file">
                 <div class="fake-input-file">
                   <div class="cross-container" id="cross-cont1">
                    <i class="icon-plus-symbol" id="cross1"></i>
                  </div>
                  <div class="file-label" id="id-label"><label>Carte d'identité</label></div>
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
              <div class="file-label" id="avs-label"><label>Carte AVS</label></div>
            </div>
          </div>
          <div class="file-container">
           <input type="file" name="lettre" id="permit-file" class="input-file">
            <div class="fake-input-file">
              <div class="cross-container" id="cross-cont3">
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

      <div class="row section-title">
        <div class="small-12 columns">
           <h2>EDITER MON CV</h2>
        </div>
      </div>

      <div class="details-container" style="max-height: 3000px; opacity: 1;">
        <form action="{{ route('cv_update', Auth::user()->id) }}" method="POST">
          <div class="summary-container cv-div">
            <h2>Résumé</h2>
            <textarea name="resume" placeholder="Votre résumé" rows="4" style="margin:.3125rem 0">
            </textarea>
          </div>
          <div class="experience-container cv-div">
            <h2>Experience</h2>
            <div id="append-experience">
              <input type="text" name="experience-title" placeholder="Titre de l'experience">
              <div style="display: flex; padding: 0; border:none; margin-bottom:0;">
                <input type="text" name="experience-from" placeholder="Date début" style="width: 20%; margin-right:10px;"/>
                <input type="text" name="experience-to" placeholder="Date fin" style="width: 20%"/>
              </div>
              <textarea name="experience-description" placeholder="Description de l'experience" rows="4" style="margin:.3125rem 0"></textarea>
              <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
            <div class="summary-container cv-div">
               <h2>Résumé</h2>
               <textarea name="resume" placeholder="Votre résumé" rows="4" style="margin:.3125rem 0"></textarea>
            </div>
            <div class="experience-container cv-div">
               <h2>Experience</h2>
               <div id="append-experience">
                 <input type="text" name="experience-title" placeholder="Titre de l'experience">
                 <div style="display: flex; padding: 0; border:none; margin-bottom:0;">
                   <input type="text" name="experience-from" placeholder="Date début" style="width: 20%; margin-right:10px;">
                   <input type="text" name="experience-to" placeholder="Date fin" style="width: 20%">
                 </div>
                 <textarea name="experience-description" placeholder="Description de l'experience" rows="4" style="margin:.3125rem 0"></textarea>
               </div>
               <button  id="add-experience" style="width:30%; margin:auto; background-color: #222; padding :10px; margin-top: .3125rem"><i class="fa fa-plus" aria-hidden="true" id="cross3"></i> Ajouter une experience</button>
             </div>
            <button  id="add-experience" style="width:30%; margin:auto; background-color: #222; padding :10px; margin-top: .3125rem"><i class="fa fa-plus" aria-hidden="true" id="cross3"></i> Ajouter une experience</button>
          </div>
          <div class="education-container cv-div">
            <h2>Education</h2>
            <div id="append-education">
              <input type="text" name="education-title" placeholder="Titre de l'éducation (comment on dit lol)">
              <div style="display: flex; padding: 0; border:none; margin-bottom:0;">
                <input type="text" name="education-from" placeholder="Date début" style="width: 20%; margin-right:10px;">
                <input type="text" name="education-to" placeholder="Date fin" style="width: 20%">
              </div>
              <textarea name="education-description" placeholder="Description de l'education" rows="4" style="margin:.3125rem 0"></textarea>
            </div>
            <button id="add-education" style="width:30%; margin:auto; background-color: #222; padding :10px; margin-top: .3125rem"><i class="fa fa-plus" aria-hidden="true" id="cross3"></i> Ajouter une éducation</button>
          </div>
          <div class="skills-container cv-div">
            <h2 style="margin-bottom: 30px;">Compétences</h2>
            <ul>
              <div id="append-skill" style="display:flex; flex-wrap: wrap;">
                <li class="li-edit-cv" style="padding:0"><input type="text" name="skill1" placeholder="Compétence"></li>
              </div>
              <button id="add-skill" style="margin:auto; margin-left:0;background-color: #222; padding :10px;"><i class="fa fa-plus" aria-hidden="true" id="cross3"></i></button>
            </ul>
          </div>
          <div class="languages-container cv-div">
            <h2 style="margin-bottom: 30px;">Langues</h2>
            <ul>
              <div id="append-language" style="display:flex; flex-wrap: wrap;">
                <li class="li-edit-cv" style="padding:0"><input type="text" name="language1" placeholder="Langue"></li>
              </div>
              <button id="add-language" style="margin:auto; margin-left: 0; background-color: #222; padding :8px;"><i class="fa fa-plus" aria-hidden="true" id="cross3"></i></button>
            </ul>
          </div>
          <div style="width:100%;display:flex;">
            <button type="submit" name="go-register" class="submit-account" value="Update">Update</button>
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
         </form>
        <div class="row section-title">
                    <div class="small-12 columns">
                       <h2>EDITER MON PROFIL</h2>
                    </div>
        </div>
        <div style="display:flex; width: 70%; margin:auto;">
          <form style="width:100%;" action="{{ route('register_update', Auth::user()->id) }}" method="POST">
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
            <label for="name">NAME : </label><input type="text" name="name">
            <label for="email">EMAIL : </label><input type="text" name="email">
            <label for="number">CONTACT NUMBER : </label><input type="text" name="number">
            <label for="year">YEAR : </label><input type="text" name="year">
            <div style="width:100%;display:flex; margin-top:30px; margin-bottom: 30px;">
            <input type="submit" name="go-register" class="submit-account" value="Update">
          </div>
        </form>
      </div>
      <div class="row section-title">
        <div class="small-12 columns">
          <h2>EDITER MON PROFIL</h2>
        </div>
      </div>
      <div style="display:flex; width: 70%; margin:auto;">
        <form style="width:100%;" action="{{ route('register_update', Auth::user()->id) }}" method="POST">
          <label for="name">NAME : </label><input type="text" name="name">
          <label for="email">EMAIL : </label><input type="text" name="email">
          <label for="number">CONTACT NUMBER : </label><input type="text" name="number">
          <label for="year">YEAR : </label><input type="text" name="year">
          <div style="width:100%;display:flex; margin-top:30px; margin-bottom: 30px;">
          <input type="submit" name="go-register" class="submit-account" value="Update">
        </div>
        </form>
      </div>

    </div>
  </div>
@endsection