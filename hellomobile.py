import pytesseract # for recognization of characters in image
import re #for regular expression
import sys #The sys module provides information about constants, functions and methods of the Python interpreter.
from PIL import Image #python imaging library to take input as image

# If you don't have tesseract executable in your PATH, include the following:
pytesseract.pytesseract.tesseract_cmd = './tesseractocr/tesseract.exe'

#argv represents all the items that come along via the command line input
url=sys.argv[1]

text = pytesseract.image_to_string(Image.open(url))

mobilenumber = re.findall(r"[0-9\s(\)\+\.-]{12,}",text)
print(mobilenumber)
