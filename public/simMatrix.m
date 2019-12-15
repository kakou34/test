function [] = simMatrix()
simMat = cell(1682,1682);
for i=1:1682
    for j = 1:i
        simMat(i,j) = num2cell(cosineSimAdj(i,j));
    end   
end

save('itemSimilarity.mat', 'simMat');
