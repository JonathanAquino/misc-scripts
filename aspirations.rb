#!/usr/bin/ruby

# This Ruby script displays a Catholic aspiration/invocation every hour using
# terminal-notifier. Make sure to install terminal-notifier first.

aspirations = [
    'Lord Jesus Christ, Son of God, have mercy on me, a sinner!',
    'Blessed be the Name of the Lord!',
    'We adore Thee, O Christ, and we bless Thee; because by Thy holy Cross Thou hast redeemed the world.',
    'May the Holy Trinity be blessed.',
    'Christ conquers! Christ reigns! Christ commands!',
    'O Heart of Jesus, burning with love for us, inflame our hearts with love for Thee.',
    'O Heart of Jesus, I place my trust in Thee.',
    'O Heart of Jesus, all for Thee.',
    'Most Sacred Heart of Jesus, have mercy on us.',
    'My God and my all.',
    'O God, have mercy on me, a sinner.',
    'Grant that I may praise thee, O sacred Virgin; give me strength against thine enemies.',
    'Teach me to do Thy will, because Thou art my God.',
    'O Lord, increase our faith.',
    'O Lord, may we be of one mind in truth and of one heart in charity.',
    'O Lord, save us, we are perishing.',
    'My Lord and my God.',
    'Glory be to the Father, and to the Son, and to the Holy Spirit.',
    'Jesus, Mary, and Joseph.',
    'Jesus, Mary, Joseph, I give you my heart and my soul. Jesus, Mary, Joseph, assist me in my last agony. Jesus, Mary, Joseph, may I sleep and rest in peace with you.',
    'May the Most Blessed Sacrament be praised and adored forever.',
    'Stay with us, O Lord.',
    'Mother of Sorrows, pray for us.',
    'My Mother, my Hope.',
    'Send, O Lord, laborers into Thy harvest.',
    'May the Virgin Mary together with her loving Child bless us.',
    'Hail, O Cross, our only hope.',
    'All you holy men and women of God, intercede for us.',
    'Pray for us, O Holy Mother of God, that we may be made worthy of the promises of Christ.',
    'Father, into Thy hands I commend my spirit.',
    'Merciful Lord Jesus, grant them everlasting rest.',
    'Queen conceived without original sin, pray for us.',
    'Holy Mother of God, Mary ever Virgin, intercede for us.',
    'Holy Mary, pray for us.',
    'Thou art the Christ, the Son of the living God.',
    'Blessed be God!',
    'All for thee, Most Sacred Heart of Jesus!',
    'Jesus, meek and humble of heart, make my heart like unto thine! (Roman Ritual)',
    'My Jesus, mercy!',
    'Thanks be to God!',
    'O Mary, conceived without sin, pray for us who have recourse to thee!',
    'Hail Mary!',
    'Sacred Heart of Jesus, I trust in Thee!',
    'Sacred Heart of Jesus, Thy kingdom come!',
    'Sweet Heart of Jesus, be my love!',
    'Holy Trinity, one God, have mercy on us!',
    'From all sin deliver me, O Lord!',
    'As the Lord wills!',
    'Thy will be done!',
]
while true do
    `afplay /System/Library/Sounds/Blow.aiff`
    `afplay /System/Library/Sounds/Blow.aiff`
    `afplay /System/Library/Sounds/Blow.aiff`
    `terminal-notifier -message "#{aspirations.shuffle.first}"`
    `sleep 3600`
end
