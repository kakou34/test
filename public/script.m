clear all; 
close all; 
clc;

item = 5;
user = 943;



load('matrix.mat', 'matrix');
%finding similarities 
similarity = zeros(1682,2);
for i=1:1682
    %check only for movies that the user rated
    if(matrix(user,i)~=0 && i ~= item)
      similarity(i,2) = cosineSimAdj(matrix, item, i);
      similarity(i,1) = matrix(user,i);
    else
        similarity(i,2) = NaN;
    end
end

similarity = sortrows(similarity, 2 , 'descend');

% finding k nearest items 
nearest_items = zeros(40, 2);
m = 1;
for i=1:1682
    if(~isnan(similarity(i,2)))
        nearest_items(m,1) = similarity(i,1);
        nearest_items(m,2) = similarity(i,2);
        m = m+1;
        if(m == 41)
            break;
        end
    end
end

up = dot(nearest_items(:,1),nearest_items(:,2));
down = sum(nearest_items(:,2));

prediction = up/down;


