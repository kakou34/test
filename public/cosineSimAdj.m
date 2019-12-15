function [sim] = cosineSimAdj(matrix, item1,item2)

%find items rates for each user 
users1 = matrix(: , item1);
users2 = matrix(: , item2);
%eliminate users who didn't rate both items
[row, ~] = size(matrix);
for i=1:row
    if (users1(i,1)~=0 && users2(i,1)~=0)
        %do nothing
    else 
        users1(i,1)=0;
        users2(i,1)=0;
    end
end
[row, ~] = find(users1 ~=0);
users1 = nonzeros(users1);
users2 = nonzeros(users2);
%adjusting vectors
for i=1:length(row)
    ru = mean(nonzeros(matrix(row(i,1),:)));
    users1(i,1) = users1(i,1) - ru;
    users2(i,1) = users2(i,1) - ru;
end
if (length(users1) == length(users2))
    sim = getCosineSimilarity(users1,users2);
else
    sim = NaN;
end

end

