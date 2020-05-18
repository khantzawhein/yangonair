var notification = document.querySelector(".notification")
if (self.Notification.permission === "granted") {
    notification.innerHTML = "Subscribed";
    notification.disabled = true;
    $('.noti-alert-row').hide();
}
function initSW(locale = 'en') {
    lang = locale;
    if (!('serviceWorker' in navigator)) {
        // Service Worker isn't supported on this browser, disable or hide UI.
        return;
      }
      
      if (!('PushManager' in window)) {
        // Push isn't supported on this browser, disable or hide UI.
        return;
      }
      navigator.serviceWorker.register('js/sw.js')
      .then(() => {
        //   console.log('serviceWorker installed!')
          initPush();
      })
      .catch((err) => {
          console.log(err)
      });
      }

function initPush() {
    if (!navigator.serviceWorker.ready) {
        return;
    }

    new Promise(function (resolve, reject) {
        const permissionResult = Notification.requestPermission(function (result) {
            resolve(result);
        });

        if (permissionResult) {
            permissionResult.then(resolve, reject);
        }
    })
        .then((permissionResult) => {
            if (permissionResult !== 'granted') {
                throw new Error('We weren\'t granted permission.');
            }
            subscribeUser();
        });
}
function subscribeUser() {
    return navigator.serviceWorker.register('js/sw.js')
    .then(function(registration) {
      const subscribeOptions = {
        userVisibleOnly: true,
        applicationServerKey: urlBase64ToUint8Array(
          'BJJBsOQLx4PfAvC446UKQiZCSwkmR7veW2b4yVMhnUmhYmmnPq2wfOpzJEYJbikcQfxTuCs1VoFh-QWbh_onibg'
        )
      };
  
      return registration.pushManager.subscribe(subscribeOptions);
    })
    .then(function(pushSubscription) {
      console.log('Received PushSubscription: ', JSON.stringify(pushSubscription));
      storePushSubscription(pushSubscription);
    });
}
function urlBase64ToUint8Array(base64String) {
    var padding = '='.repeat((4 - base64String.length % 4) % 4);
    var base64 = (base64String + padding)
        .replace(/\-/g, '+')
        .replace(/_/g, '/');

    var rawData = window.atob(base64);
    var outputArray = new Uint8Array(rawData.length);

    for (var i = 0; i < rawData.length; ++i) {
        outputArray[i] = rawData.charCodeAt(i);
    }
    return outputArray;
}
function storePushSubscription(pushSubscription) {
    const token = document.querySelector('meta[name=csrf-token]').getAttribute('content');

    fetch('/push', {
        method: 'POST',
        body: JSON.stringify(pushSubscription),
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-Token': token,
            'locale': lang
        }
    })
        .then((res) => {
            return res.json();
        })
        .then((res) => {
            console.log(res)
        })
        .catch((err) => {
            console.log(err)
        });
        notification.innerHTML = "Subscribed";
        notification.disabled = true;
        $('.noti-alert').alert('close');
}