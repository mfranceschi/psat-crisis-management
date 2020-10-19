
import requests

SERVER_IP = "192.168.1.78"
SERVER_PORT = 80
SERVER_ENDPOINT = "login.php"

# Basic test
test1_response = requests.post(
    url=f"http://{SERVER_IP}:{SERVER_PORT}/{SERVER_ENDPOINT}",
    json={"username": "admin", "password": "admin1234"}
    )
assert(200 <= test1_response.status_code < 400)

# Injection1

