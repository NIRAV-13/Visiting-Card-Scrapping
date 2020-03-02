import pytesseract
import re
import sys
from PIL import Image
pytesseract.pytesseract.tesseract_cmd = './tesseractocr/tesseract.exe'
url=sys.argv[1]

text = pytesseract.image_to_string(Image.open(url))

urls = re.findall("[w]{3}\.+[a-z0-9\.]{1,}\.+[a-zA-z]{,100}",text)

print(urls)
