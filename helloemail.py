import pytesseract  # for recognization of characters in image
import re #for regular expression
import sys #The sys module provides information about constants, functions and methods of the Python interpreter.
from PIL import Image  #python imaging library to take input as image

# If you don't have tesseract executable in your PATH, include the following:
pytesseract.pytesseract.tesseract_cmd = './tesseractocr/tesseract.exe'
url=sys.argv[1]   #argv represents all the items that come along via the command line input
text = pytesseract.image_to_string(Image.open(url))
emails = re.findall(r"[a-z0-9\.\-+_]+@[a-z0-9\.\-+_]+\.[a-z]+", text)
print(emails)
