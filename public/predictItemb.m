function [prediction] = predictItemb(item, user)
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
nearest_items = zeros(20, 2);
m = 1;
for i=1:1682
    if(~isnan(similarity(i,2)))
        nearest_items(m,1) = similarity(i,1);
        nearest_items(m,2) = similarity(i,2);
        m = m+1;
        if(m == 21)
            break;
        end
    end
end

%remove not similar items
for i=1:20
   if( nearest_items(i,2)<0)
       nearest_items(i,2)=0;
   end
end

up = dot(nearest_items(:,1),nearest_items(:,2));
down = sum(nearest_items(:,2));

prediction = up/down;
end

