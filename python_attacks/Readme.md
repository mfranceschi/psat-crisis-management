# Python attacks

(not up to date)

## 1. Brute force SSH

### 1.1. Description

The program will run a loop (the "main loop") and attempt to connect by SSH to a remote computer.
The loop will run until a timer elapses, and it will iterate over a list of common passwords.
The authentication must not succeed by using that list.
At the end, we do a succesful login attempt to demonstrate that we can actually connect to SSH.

### 1.2. Usage

No command-line arguments currently. The settings are to be managed at the top of the file.

## 2. DOS Apache2

### 2.1. Description

Simple DOS against a specific URL.
We create several threads and each thread runs several times the same GET request.
We do a first attempt to ensure that the URL is reachable and returns a non-error HTTP status code.

### 2.2. Usage

No command-line arguments currently. The settings are to be managed at the top of the file.

## 3. Slow Loris

### 3.1. Description

This attack is specific to Apache 1.x and 2.x servers. For more details:

- <https://github.com/adrianchifor/pyslowloris> (original script, I just edited to set the number of sockets)
- <https://www.youtube.com/watch?v=XiFkyR35v2Y>

### 3.2. Usage

`python3 slowloris.py <ip> [<nbr>]`, where `ip` is the IP of the server (the port is always 80) and the optional `nbr` is the number of sockets to create. For example, with me:

`python slowloris.py 192.168.1.78 500`
