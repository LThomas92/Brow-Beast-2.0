/**
 * Contact Form — client-side validation + AJAX submit
 * Save as src/modules/contact.js
 * Add initContact() call to src/index.js
 */

export function initContact() {
  const form   = document.getElementById( 'contactForm' );
  if ( ! form ) return;

  form.addEventListener( 'submit', async ( e ) => {
    e.preventDefault();

    if ( ! validateForm( form ) ) return;

    const btn     = document.getElementById( 'formSubmit' );
    const label   = btn.querySelector( '.btn-label' );
    const loading = btn.querySelector( '.btn-loading' );
    const success = document.getElementById( 'formSuccess' );

    // Show loading state
    btn.disabled    = true;
    label.hidden    = true;
    loading.hidden  = false;

    try {
      const data = new FormData( form );
      data.append( 'action', 'browbeast_contact' );

      const res  = await fetch( window.BrowBeast?.ajaxUrl ?? '/wp-admin/admin-ajax.php', {
        method: 'POST',
        body:   data,
      } );

      const json = await res.json();

      if ( json.success ) {
        form.hidden    = true;
        success.hidden = false;
      } else {
        showFormError( form, json.data?.message ?? 'Something went wrong. Please try again.' );
        resetBtn( btn, label, loading );
      }

    } catch ( err ) {
      showFormError( form, 'Network error. Please check your connection and try again.' );
      resetBtn( btn, label, loading );
    }
  } );
}


function validateForm( form ) {
  let valid = true;

  // Clear previous errors
  form.querySelectorAll( '.form-error' ).forEach( el => el.textContent = '' );

  const name    = form.querySelector( '#contact_name' );
  const email   = form.querySelector( '#contact_email_field' );
  const message = form.querySelector( '#contact_message' );

  if ( ! name?.value.trim() ) {
    setError( name, 'Please enter your name.' );
    valid = false;
  }

  if ( ! email?.value.trim() || ! /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test( email.value ) ) {
    setError( email, 'Please enter a valid email address.' );
    valid = false;
  }

  if ( ! message?.value.trim() ) {
    setError( message, 'Please enter a message.' );
    valid = false;
  }

  return valid;
}

function setError( input, msg ) {
  if ( ! input ) return;
  const err = input.closest( '.form-field' )?.querySelector( '.form-error' );
  if ( err ) err.textContent = msg;
  input.focus();
}

function showFormError( form, msg ) {
  // Show a general error above the submit button
  let general = form.querySelector( '.form-general-error' );
  if ( ! general ) {
    general = document.createElement( 'p' );
    general.className = 'form-general-error form-error';
    form.querySelector( '.form-submit' ).before( general );
  }
  general.textContent = msg;
}

function resetBtn( btn, label, loading ) {
  btn.disabled   = false;
  label.hidden   = false;
  loading.hidden = true;
}