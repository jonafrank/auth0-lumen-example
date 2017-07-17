<html>
    <head>
        <script src="https://cdn.auth0.com/js/lock/10.16/lock.min.js"></script>
        <script>
            var lock = new Auth0Lock('pHlH_Pmsb-nv3f8tPQGA8o1XLDhmEFAm', 'jonafrank.auth0.com', {
                auth: {
                    redirectUrl: 'http://local.auth0.com/auth0/callback',
                    responseType: 'code',
                    params: {
                        scope: 'openid' // Learn about scopes: https://auth0.com/docs/scopes
                    }
                }
            });
            lock.on("authenticated", function(authResult) {
                // Use the token in authResult to getUserInfo() and save it to localStorage
                lock.getUserInfo(authResult.accessToken, function(error, profile) {
                    if (error) {
                        console.log(error);
                        // Handle error
                        return;
                    }

                    localStorage.setItem('accessToken', authResult.accessToken);
                    localStorage.setItem('profile', JSON.stringify(profile));
                });
            })
        </script>
    </head>
    <body>
        <button onclick="lock.show();">Login</button>
        <a href="/secure-route">This Route is secured</a>
    </body>
</html>
