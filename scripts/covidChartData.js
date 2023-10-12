// chart colors
var colors = ['#353941', '#26282B', '#B5C2B7', '#5F85DB', '#90B8F8'];

const mentalHealthData = {
    labels: [
        "Finland", "Netherlands", "Norway", "France", "Spain", "Sweden",
        "Germany", "Belgium", "United Kingdom", "Greece", "Austria",
        "Switzerland", "Cyprus", "Italy", "Denmark", "Hungary", "Czech Rep.",
        "Poland", "Bulgaria", "Romania"
    ],
    datasets: [
        {
            data: [4.6, 7.5, 7.5, 6.2, 5.7, 5.6, 5.9, 5.8, 5.7, 6, 6, 7, 6, 6.1, 6, 4.6, 4.6, 4.6, 4.6, 4.6],
            backgroundColor: colors[0],
            label: "Anxiety Disorders"
        },
        {
            data: [5.3, 5, 5.1, 5.6, 4.3, 5, 4.7, 4.7, 4.7, 5.3, 4.5, 4.8, 4.7, 4.8, 4.6, 4.8, 4.6, 4.2, 4.6, 4.2],
            backgroundColor: colors[1],
            label: "Depressive Disorders"
        },
        {
            data: [3.9, 1.5, 2.2, 2.2, 1.8, 2.8, 2.9, 2.5, 2.6, 1.5, 2.3, 2.2, 1.6, 1.5, 1.9, 2, 1.9, 2.2, 1.9, 1.9],
            backgroundColor: colors[2],
            label: "Alcohol and Drug Use Disorders"
        },
        {
            data: [1.2, 1, 1.2, 1, 1, 1.6, 0.8, 1.2, 1.2, 1.4, 1.4, 1.2, 1.3, 1.2, 1.3, 0.8, 0.8, 0.8, 0.8, 0.7],
            backgroundColor: colors[3],
            label: "Bipolar Disorders and Schizophrenia"
        },
        {
            data: [3.8, 3.6, 2.5, 3.5, 5.5, 3.3, 3.7, 3.7, 3.5, 3.5, 3.5, 2.3, 3.4, 3.4, 3.1, 3.2, 3.2, 3.1, 2.9, 2.9],
            backgroundColor: colors[4],
            label: "Others"
        }
    ]
}

const physicalHealthData = {
    labels: [
        "Germany", "United Kingdom", "Switzerland", "Sweden", "Ireland", "Austria",
        "Netherlands", "Belgium", "Finland", "Denmark", "Estonia", "Norway", "Russia",
        "Poland", "Czech Rep.", "France", "Romania", "Portugal", "Italy", "Spain"
    ],
    datasets: [
        {
            data: [8.1, 8.6, 8.6, 9.7, 9.7, 11.1, 11.1, 11.1, 12.3, 12.3, 12.3, 14.6, 17.2, 18, 20, 20, 23.8, 25, 25, 37.8],
            backgroundColor: [colors[0], colors[0], colors[0], colors[0],
            colors[1], colors[1], colors[1], colors[1],
            colors[2], colors[2], colors[2], colors[2],
            colors[3], colors[3], colors[3], colors[3],
            colors[4], colors[4], colors[4], colors[4]],
            label: "% Reduction in Physical Activity"
        }
    ]
}