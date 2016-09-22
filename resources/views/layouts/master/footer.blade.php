<footer class="footer">
   <div class="row full-width informations">

      <div class="small-3 columns">
         <ul>
            <li class="title">@lang('footer.aboutUs')</li>
            <li><a href="{{ route('missionStatement') }}">@lang('footer.ourPrinciples')</a></li>
            <li><a href="{{ route('ourTeam') }}">@lang('footer.ourTeam')</a></li>
            <li><a href="404">@lang('footer.events')</a></li>
            <li><a href="404">@lang('footer.pressInfo')</a></li>
         </ul>
      </div>

      <div class="small-3 columns">
         <ul>
            <li class="title">@lang('footer.yourExtrasMe')</li>
            <li><a href="404">@lang('footer.privacy')</a></li>
            <li><a href="404">@lang('footer.helpCenter')</a></li>
         </ul>
      </div>

      <div class="small-3 columns">
         <ul>
            <li class="title">@lang('footer.contactUs')</li>
            <li><a href="{{ route('contactUs') }}">@lang('footer.contactPage')</a></li>
            <li><a href="404">@lang('footer.becomeAnbassador')</a></li>
         </ul>
      </div>

      <div class="small-3 columns">
         <ul class="socials-medias">

            <li><a href="https://www.facebook.com/pages/ExtrasMe/512698772202407?ref=hl">
               <img src="{{ asset('images/social-medias/facebook.png') }}" alt="ExtrasMe's Facebook" />
            </a></li>

            <li><a href="https://twitter.com/Extras_Me">
               <img src="{{ asset('images/social-medias/twitter.png') }}" alt="ExtrasMe's Twitter" />
            </a></li>

            <li><a href="https://www.linkedin.com/company/10451089?trk=tyah&trkInfo=clickedVertical%3Acompany%2CclickedEntityId%3A10451089%2Cidx%3A3-1-4%2CtarId%3A1473948514150%2Ctas%3Aextras%20me">
               <img src="{{ asset('images/social-medias/linkedin.png') }}" alt="ExtrasMe's Linkedin" />
            </a></li>

            <li><a href="https://www.instagram.com/extras.me/">
               <img src="{{ asset('images/social-medias/instagram.png') }}" alt="ExtrasMe's Instagram" />
            </a></li>

         </ul>
      </div>

   </div>

   <div class="row full-width disclaimers">
      <div class="small-6 columns copyright">
         Copyright © 2015 <a href="">ExtrasMe Inc.</a> @lang('footer.allRightsReserved')
      </div>
      <div class="small-6 columns">
         <ul>
            <li><a href="404">@lang('footer.privacyPolicy')</a></li>
            <li><a href="404">@lang('footer.termsOfUse')</a></li>
            <li><a href="404">@lang('footer.salesRefund')</a></li>
            <li><a href="404">@lang('footer.sitemap')</a></li>
         </ul>
      </div>
   </div>
</footer>
