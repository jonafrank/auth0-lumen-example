<html>
    <head>
        <script src="https://cdn.auth0.com/js/lock/10.16/lock.min.js"></script>
        <script>
            var lock = new Auth0Lock('pHlH_Pmsb-nv3f8tPQGA8o1XLDhmEFAm', 'jonafrank.auth0.com', {
                auth: {
                    redirectUrl: 'http://local.auth0.com/auth0/callback',
                    responseType: 'code',
                    params: {
                        scope: 'openid email' // Learn about scopes: https://auth0.com/docs/scopes
                    }
                }
            });
            </script>
    </head>
    <body>
        <button onclick="lock.show();">Login</button>
        <a href="/secure-route">This Route is secured</a>
    </body>
</html>
