!function(e){var t={};function n(r){if(t[r])return t[r].exports;var o=t[r]={i:r,l:!1,exports:{}};return e[r].call(o.exports,o,o.exports,n),o.l=!0,o.exports}n.m=e,n.c=t,n.d=function(e,t,r){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:r})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var r=Object.create(null);if(n.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var o in e)n.d(r,o,function(t){return e[t]}.bind(null,o));return r},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="/",n(n.s=12)}({12:function(e,t,n){e.exports=n("4ZNv")},"4ZNv":function(e,t){var n,r,o,i=!1;$(document).ready((function(){var e;e=$("#stripe-token"),n=Stripe(e.val()),r=n.elements(),$("#subscribe-confirm").on("shown.bs.modal",(function(){!function(){if(1===$("#card-element").length){if(!o){o=r.create("card",{hidePostalCode:!0,style:{base:{color:"#555555",fontFamily:'"Helvetica Neue", Helvetica, sans-serif',fontSmoothing:"antialiased",fontSize:"14px","::placeholder":{color:"#777777"}},invalid:{color:"#fa755a",iconColor:"#fa755a"}}})}o.mount("#card-element")}$("#subscription-confirm").submit((function(e){if(i)return!0;e.preventDefault();var t=$("#subscription-confirm-button");t.addClass("disabled").html('<i class="fa fa-spin fa-spinner"></i>');var r=$('input[name="subscription-intent-token"]'),a=$(".alert-danger");a.hide(),console.log("intent token",r.val(),r);var u=$('input[name="payment_id"]');if(u.val())return i=!0,$("#subscription-confirm").submit(),!1;n.confirmCardSetup(r.val(),{payment_method:{card:o,billing_details:{name:$('input[name="card-holder-name"]').val()}}}).then(function(e){if(e.error)return t.removeClass("disabled").text(t.data("text")),a.text(e.error.message).show(),!1;u.val(e.setupIntent.payment_method),i=!0,$("#subscription-confirm").submit()}.bind(this))}))}()}))}))}});