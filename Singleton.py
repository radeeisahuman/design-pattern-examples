import threading

class Singleton:
    _instance = None
    _lock = threading.Lock()

    def __new__(cls):

        with cls._lock:
            if cls._instance is None:
                cls._instance = super(Singleton, cls).__new__(cls)
        
        return cls._instance
    

"""
Problem:
You’re building a logging system for an application. You must ensure:

Only one logger instance exists across the whole application.

All components log to the same file.

You can write messages like INFO, ERROR, or DEBUG, and all messages should be saved in order to a file.

🔧 Requirements:
Create a Logger class that implements the Singleton pattern.

It should write log messages to a file named app.log.

The class should have a method like log(level, message) where level is a string (e.g. "INFO", "ERROR").

Demonstrate that multiple instances refer to the same logger by creating it from different parts of your script and checking the file content.

💡 Bonus:
Make it thread-safe so multiple threads can log at the same time without duplicating the instance.

"""

class Logger:
    _instance = None
    _lock = threading.Lock()

    def __new__(cls):
        with cls._lock:
            if cls._instance is None:
                cls._instance = super(Logger, cls).__new__(cls)

        return cls._instance
    
    def log(self, level: str, message: str):
        print(f'Writing to app.log = {level}: {message}')