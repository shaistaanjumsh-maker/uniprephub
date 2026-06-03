import re
path = r"public/build/assets/Home-B5Y2SFzX.js"
text = open(path, 'r', encoding='utf-8', errors='ignore').read()
for name in ['WhatIsOnPlatform','WatchOnYoutube','LiveQuizSection','AchievementSection']:
    idx = text.find(name)
    print('\n---', name, 'idx', idx)
    if idx >= 0:
        start = max(0, idx - 1200)
        end = min(len(text), idx + 1200)
        snippet = text[start:end]
        print(snippet)
