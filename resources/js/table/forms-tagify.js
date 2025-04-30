/**
 * Tagify
 */

'use strict';

(function () {
  // Basic
  //------------------------------------------------------
  const tagifyBasicList = document.querySelectorAll('.tagifyBasic');
    for (let i = 0; i < tagifyBasicList.length; i++) {
        new Tagify(tagifyBasicList.item(i));
    }
})();
