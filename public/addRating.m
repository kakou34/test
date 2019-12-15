function [] = addRating(userID, json)
load('matrix.mat', 'matrix');



ratings = jsondecode(json);
[row, col] = size(ratings);

for i=1:row 
 matrix(userID, ratings(i,1)) = ratings(i,2);
end
save('matrix.mat','matrix','-append');
end

