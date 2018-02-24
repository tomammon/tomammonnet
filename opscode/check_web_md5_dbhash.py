#!/usr/bin/python
import os,re,sys,urllib,MySQLdb
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
parser.add_option('-s', '--server', dest='server')
parser.add_option('-t', '--port', dest='port')
parser.add_option('-u', '--user', dest='username')
parser.add_option('-p', '--password', dest='password')
parser.add_option('-d', '--database', dest='database')

options, args = parser.parse_args()

portint = int(options.port)

dbcon = MySQLdb.connect(host=options.server,port=portint,user=options.username,passwd=options.password,db=options.database)
cursor = dbcon.cursor()
cursor.execute("SELECT hash FROM hashes WHERE component='frontpage'")

expectedhash = cursor.fetchone()

pagemd5 = open_webpage(options.url)

if pagemd5 == expectedhash[0]:
    print "OK - md5sum matches expected value of %s" % expectedhash[0]
    sys.exit(0)
else:
    print "CRITICAL - md5sum does not match the expected value, current md5 = %s" % pagemd5
    sys.exit(2)
