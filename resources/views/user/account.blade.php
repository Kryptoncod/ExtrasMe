@extends('layouts.master', ["title" => trans('profile.title.student', ["name" => $user->username]), "footer" => false])
@section('content')

   <div class="row collapse profile profile-container">
      @include('user.sidebar', ['nav' => ['MY PAST EXPERIENCE' => ''], 'formType' => 0])

      <div class="medium-10 small-12 columns panel-main">
         <div class="row section-title">
                    <div class="small-12 columns">
                       <h2>S'ENREGISTRER</h2>
                    </div>
        </div>
        <div class="row register-form-container">
          <form>
            <div class="file-container">
                 <input type="file" name="cv" id="id-file" class="input-file">
                 <div class="fake-input-file">
                   <div class="cross-container" id="cross-cont1">
                    <i class="fa fa-plus" aria-hidden="true" id="cross1"></i>
                  </div>
                  <div class="file-label" id="id-label"><label>Carte d'identité</label></div>
                </div>
              </div>
              <div class="file-container">
               <input type="file" name="lettre" id="avs-file" class="input-file">
               <div class="fake-input-file">
                 <div class="cross-container" id="cross-cont2">
                  <i class="fa fa-plus" aria-hidden="true" id="cross2"></i>
                </div>
                <div class="file-label" id="avs-label"><label>Carte AVS</label></div>
              </div>
            </div>
            <div class="file-container">
             <input type="file" name="lettre" id="permit-file" class="input-file">
             <div class="fake-input-file">
               <div class="cross-container" id="cross-cont3">
                <i class="fa fa-plus" aria-hidden="true" id="cross3"></i>
              </div>
              <div class="file-label" id="permit-label"><label>Permis de travail</label></div>
            </div>
          </div>
          </form>
          
        </div>
        <div class="row section-title">
                    <div class="small-12 columns">
                       <h2>EDITER MON CV</h2>
                    </div>
        </div>
        <div class="details-container" style="max-height: 3000px; opacity: 1;">
        <form>
            <div class="summary-container">
               <h2>Résumé</h2>
               <textarea placeholder="Votre résumé" rows="4" style="margin:.3125rem 0"></textarea>
            </div>
            <div class="experience-container">
               <h2>Experience</h2>
               <input type="text" name="experience-title" placeholder="Titre de l'experience">
               <div style="display: flex; padding: 0; border:none; margin-bottom:0;">
                 <input type="text" name="from" placeholder="Date début" style="width: 20%; margin-right:10px;">
                 <input type="text" name="to" placeholder="Date fin" style="width: 20%">
               </div>
               <textarea placeholder="Description de l'experience" rows="4" style="margin:.3125rem 0"></textarea>
               <button style="width:30%; margin:auto; background-color: #222; padding :10px; margin-top: .3125rem"><i class="fa fa-plus" aria-hidden="true" id="cross3"></i> Ajouter une experience</button>
            </div>
            <div class="education-container">
               <h2>Education</h2>
               <input type="text" name="education-title" placeholder="Titre de l'éducation (comment on dit lol)">
               <div style="display: flex; padding: 0; border:none; margin-bottom:0;">
                 <input type="text" name="from" placeholder="Date début" style="width: 20%; margin-right:10px;">
                 <input type="text" name="to" placeholder="Date fin" style="width: 20%">
               </div>
               <textarea placeholder="Description de l'education" rows="4" style="margin:.3125rem 0"></textarea>
               <button style="width:30%; margin:auto; background-color: #222; padding :10px; margin-top: .3125rem"><i class="fa fa-plus" aria-hidden="true" id="cross3"></i> Ajouter une éducation</button>
            </div>
            <div class="skills-container">
            <h2 style="margin-bottom: 30px;">Compétences</h2>
               <ul>
                  <li class="li-edit-cv" style="padding:0"><input type="text" name="skill" placeholder="Compétence"></li>
                  <li style="padding:0"><button style="margin:auto; background-color: #222; padding :10px;"><i class="fa fa-plus" aria-hidden="true" id="cross3"></i></button></li>
               </ul>
            </div>
            <div class="languages-container">
            <h2 style="margin-bottom: 30px;">Langues</h2>
               <ul>
                  <li class="li-edit-cv" style="padding:0"><input type="text" name="skill" placeholder="Langue"></li>
                  <li style="padding:0"><button style="margin:auto; background-color: #222; padding :8px;"><i class="fa fa-plus" aria-hidden="true" id="cross3"></i></button></li>
               </ul>
            </div>
         </div>
         </form>
        <div class="row section-title">
                    <div class="small-12 columns">
                       <h2>EDITER MON PROFIL</h2>
                    </div>
        </div>

      </div>

   </div>
@endsection