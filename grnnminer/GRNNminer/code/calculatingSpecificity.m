% -----------------------------------------------------------------------%
% 201405
% Rubiolo, Milone and Stegmayer. 
% Calculating accuracy measure.
% 
% INPUT:
% values: True positive (TP), True negatives (TN), False positives (FP) and False Negatives (FN) values.
% 
% OUTPUT:
% accuracy: accuracy value.
% -----------------------------------------------------------------------%

function[specificity] = calculatingSpecificity(values)

TP=values(1);
TN=values(2);
FP=values(3);
FN=values(4);
specificity = (TN)/(TN+FP);


