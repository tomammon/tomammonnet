#!/usr/bin/python
import os,re,sys,urllib
from optparse import OptionParser
import hashlib

def open_webpage(url):
    """Download the web page and calculate an md5 sum
    If an exception is raised, exit with Nagios CRITICAL status
    """
    try:
        page = urllib.urlopen(url)
    except Exception, e:
        print 'CRITICAL - Could not connect to %s: %s' % (url, e)
        sys.exit(2)
    pagedata = page.read()
    md5sum = hashlib.md5(pagedata).hexdigest()
    return md5sum

parser = OptionParser()
parser.add_option('-U', '--url', dest='url')
parser.add_option('-m', '--md5', dest='md5hash')

options, args = parser.parse_args()


pagemd5 = open_webpage(options.url)

if pagemd5 == options.md5hash:
    print "OK - md5sum matches expected value"
    sys.exit(0)
else:
    print "CRITICAL - md5sum does not match the expected value"
    sys.exit(2)
