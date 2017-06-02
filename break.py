
from Bio.SeqRecord import SeqRecord
from Bio.Alphabet import IUPAC, generic_dna
from Bio.SeqFeature import SeqFeature, FeatureLocation
from Bio import Restriction
from Bio.Restriction import *
from Bio.Seq import Seq
from Bio.Alphabet import generic_dna, generic_protein
from Bio.SeqUtils import MeltingTemp as mt
from subprocess import call
from StringIO import StringIO
import os
import sys
import copy
import time
import csv
import pymysql.cursors
n=7
db = pymysql.connect(host='localhost',user='root',passwd='HiMommy12')
cursor = db.cursor()
best=db.cursor()
query="SELECT * FROM GNPNDB.newGenes"
best.execute(query)
img=best.fetchone()
b=1
places=[]
while img:
        print img
        img=best.fetchone()
        print b
        b=b+1
while n>1:
       
        queryFirst="SELECT * From GNPNDB.newGenes Where CDS LIKE '%added_"                                +str(n)+"%'"
        best.execute(queryFirst)
        start=best.fetchone()
        while start:
                lowNum=start[0]-1
                if n==7:
                        seq=start[4][45:]
                if n==5:
                        seq=start[4][48:]
                if n==3:
                        seq=start[4][49:]
                seq=start[4][50:]
                
               
                
                querynew="UPDATE GNPNDB.newGenes SET ONS="+finalSeq[2:]+" WHERE GeneID="+str(lowNum)
                worst.execute(querynew)
                worst.execute(queryFinal)
                start=best.fetchone()
                
        n=n-1
finals=', '.join(places)
print "DELETE FROM  GNPNDB.newGenes Where newGenes.CDS in '"+finals+"'"
  
