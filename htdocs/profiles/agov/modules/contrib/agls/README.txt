=========================================
Description
=========================================

The AGLS module extends the Meta tags (http://drupal.org/project/metatag) module
to add AGLS Metadata Standard tags.

The AGLS Metadata Standard is a set of descriptive properties to improve
visibility and availability of online resources.


=========================================
Meta tags
=========================================

* AGLSTERMS.act
* AGLSTERMS.aggregationLevel
* AGLSTERMS.availability
* AGLSTERMS.case
* AGLSTERMS.category
* AGLSTERMS.dateLicenced
* AGLSTERMS.documentType
* AGLSTERMS.function
* AGLSTERMS.jurisdiction
* AGLSTERMS.mandate
* AGLSTERMS.protectiveMarking
* AGLSTERMS.regulation
* AGLSTERMS.rightsHolder
* AGLSTERMS.spatial
* AGLSTERMS.temporal


=========================================
Meta tag obligation in AGLS compliance
=========================================

The AGLS standard states that metadata properties fall into one of four
obligation categories:
* Mandatory
 - dcterms:creator
 - dcterms:title
 - dcterms:date (a related term may be substituted)
* Conditional
 - aglsterms:availability (mandatory for offline resources)
 - dcterms:identifier (mandatory for online resources)
 - dcterms:publisher (mandatory for information resources - optional for
   descriptions of services)
* Recommended
 - aglsterms:function (if dcterms:subject is not used)
 - dcterms:description
 - dcterms:language (where the language of the resource is not English)
 - dcterms:subject (if aglsterms:function is not used)
 - dcterms:type
* Optional
 - All other properties are optional.

 
=========================================
References and further reading
=========================================

* AGLS Metadata Standard:
http://www.agls.gov.au/

* AGLS Reference Description:
http://www.agls.gov.au/pdf/AGLS%20Metadata%20Standard%20Part%201%20Reference%20Description.PDF

* AGLS Usage Guide:
http://www.agls.gov.au/pdf/AGLS%20Metadata%20Standard%20Part%202%20Usage%20Guide.PDF

* Guide to expressing AGLS metadata in XML:
http://www.agls.gov.au/pdf/Guide%20to%20expressing%20AGLS%20metadata%20in%20XML%20v1.0.PDF

* Guide to expressing AGLS metadata in rdf:
http://www.agls.gov.au/pdf/Guide%20to%20expressing%20AGLS%20metadata%20in%20RDF%20v1.0.PDF


=========================================
Credits / Contact
=========================================

Currently maintained by Damien McKenna [1]. Originally written by Kim Pepper
[2], with contributions by Nick Schuch [3], Christopher Skene [4] and others in
the community, with sponsorship by Previous Next Pty Ltd [5], the Australian
Law Reform Commission [6] and the Australian Department of Families, Housing,
Community Services and Indigenous Affairs [7].

The best way to contact the authors is to submit an issue, be it a support
request, a feature request or a bug report, in the project issue queue:
  https://www.drupal.org/project/issues/agls


References
------------------------------------------------------------------------------
1: https://www.drupal.org/u/damienmckenna
2: https://www.drupal.org/u/kim.pepper
3: https://www.drupal.org/u/nick_schuch
4: https://www.drupal.org/u/xtfer
5: https://www.previousnext.com.au
6: http://www.alrc.gov.au/
7: https://www.dss.gov.au/
