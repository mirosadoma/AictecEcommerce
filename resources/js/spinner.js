
$(document).ajaxStart(function() {
    this.querySelector('#loading').classList.add('loading');
    this.querySelector('#loading-content').classList.add('loading-content');
  });

  /**
   * Hide spinner
   */

  $(document).ajaxStop(function() {
    this.querySelector('#loading').classList.remove('loading');
    this.querySelector('#loading-content').classList.remove('loading-content');

  });
