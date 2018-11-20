window.addEventListener("load", (() => {

  const targetClassName = 'elm-to-switch-layout';
  const cookieName = 'useDeviceWidth';

  const toggleCookieValue = () => {
    const getCookie = (name) => {
        const value = "; " + document.cookie;
        const parts = value.split("; " + name + "=");
        if (parts.length == 2) return parts.pop().split(";").shift();
    };
    const val = (getCookie(cookieName) === '1') ? '0' : '1';
    document.cookie = `${cookieName}=${val}`;
  };

  return (event) => {
    const elms = document.getElementsByClassName(targetClassName);
    let i;

    for (i = 0; i < elms.length; i++) {
        elms[i].addEventListener('click', (event) => {
          toggleCookieValue();
          location.reload();
        });
    }
  };
})());
