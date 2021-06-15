const loggedIn = document.getElementById('loggedInToast')

let loggedInToast = null
if (loggedIn) {
  loggedInToast = new bootstrap.Toast(loggedIn)
}

if (loggedInToast) loggedInToast.show()
