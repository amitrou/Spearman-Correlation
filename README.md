Spearman-Correlation
====================

PHP implementation of the Spearman Correlation with results matrix

Spearman Rank Correlation
-------------------------

Discovers linear and non-linear monotonic trends between your database variables applying Spearman Rank Correlation. Applicable on ordinal discrete or continuous data. Useful on those situations when Pearson Correlation has lower reliability.


Synopsis
--------

Spearman Correlation analyze data positions once sorted, allowing a general usage calculation of coefficients between variables in those situations when Pearson has lower reliability (non-linear and/or non-parametric data). It can also be applicable on most scenarios discovering linear as well as non-linear monotonic trends.


Introduction
------------

The evaluation of the associativity between two random variables is generally achieved applying the Pearson Correlation technique, which usage is generally widespread among continuous variables also requiring them to have a similar curve shape to the Normal Distribution (known as parametric data).
On those cases when we need to analyze ordinal data regardless its distribution shape, I came across the Spearman Rank Correlation, which is suitable on most situations including continuous variables or even mixed types. Another advantage of Spearman over Pearson relies on the fact that the second one is just able to detect linear associativity between two variables, while Spearman can also detect other monotonic trends such as exponential and logarithmic shapes.

While available on SPSS or R-Project, I didn’t find PHP implementations on Spearman Correlation to analyze the mixed types of data I’ve been collecting from a Website. So I have developed a class with some guidance from online sources; with the aim of scheduling a batch process overnight confronting all the available data and producing a similar to “Google correlate” result. This sort of analysis has data mining applications and are becoming increasingly useful if we are committed to provide a customized user experience what is being referenced on some sources as Web 3.0. 


Compared to Pearson Correlation
-------------------------------

As discussed previously, Spearman Correlation is more suitable on dealing with mixed types of data and has a more reliable correlation detection on monotonic non-linear trends being also proficient detecting linear correlations.
This method becomes less reliable when data is truncated as in those cases when values are split into groups. This happens because the calculation is carried over data positions converted into ranks instead of using their actual values, which eliminates any sign of the truncation itself not reflecting the actual data trend.
In both correlation analysis if the resulting value is near to 1, variables are positively correlated. If it’s similar to -1 both are negatively correlated as one of them increases while the other variable decreases. On the other hand, when the result is around 0, both variables are said to be uncorrelated. To better clarify this matter, I’m leaving a couple of links by the end of this text for further consultation.


Further indications
-------------------

Categorical ordinal data refers to those variables which have correlative meaning as for instance “perceived quality”, having values like low, average and high. It also can be used on ranges of continuous and discrete values as “income”, containing values like poor, low, average, high and wealthy.
In case you are analyzing this ordinal information, please concatenate a sortable value at the beginning to reflect the correct relation order between values (i.e.: A_low, B_average, C_high) or just replace input values with “a, b, c”; “0, 1, 2”; whatever maintains the ordinal meaning once sorted. In any case you are required to provide a matrix [method testMatrix()] or two arrays [method test()] containing the same amount of rows, otherwise the result will be set as NULL. Please refer to the included testDrive.php source code for usage indications.


Further development
-------------------

1.	Detection of truncated data
2.	Significance determination 


References
----------

[English]
http://en.wikipedia.org/wiki/Spearman's_rank_correlation_coefficient
http://www.economicsnetwork.ac.uk/statistics/pearson_spearman.htm
http://www.johnmyleswhite.com/notebook/2009/02/17/pearson-vs-spearman-correlation-coefficients/
https://statistics.laerd.com/statistical-guides/spearmans-rank-order-correlation-statistical-guide.php
http://changingminds.org/explanations/research/analysis/spearman.htm
https://statistics.laerd.com/calculators/spearmans-rank-order-correlation-calculator.php
http://www.maccery.com/maths/
http://changingminds.org/explanations/research/analysis/choose_correlation.htm
[Spanish]
http://personal.us.es/carlos6262/contenido/pdf/6.pdf


License
-------

This development subscribes to GPL license model. If it’s useful to you, please be so kind to leave a link to Alejandro Mitrou [www.WiseTonic.com] in your acknowledgment page and/or within your documentation. This software is provided as it is, without warranty of any kind express or implied.

