var configuration = {
   abide: {
      live_validate: true,
      validate_on_blur: true,
      error_labels: true,

      validators: {
         after_now: afterNow,
      },

      patterns: {
         time: /^(0[0-9]|1[0-9]|2[0-3])(:[0-5][0-9])$/,
         abovezero: /^[1-9][0-9]*$/
      }
   }
};

$(document).foundation(configuration);

function afterNow(el, required, parent) {
   var timeDiff = new Date().getTime() - new Date(el.value).getTime();
   return true;
   return timeDiff < 0;
}
